<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;
use App\Models\Arm_reports;
use App\Models\Arm_payment_detail;
use Laravel\Cashier\Cashier;
use App\Mail\mailToAdminBeforePayment;
use App\Mail\mailToAdminAfterPayment;
use App\Mail\mailToUserAfterPayment;
use App\Mail\mailToAdminAfterPaymentCancel;
use App\Mail\mailToUserAfterPaymentCancel;
use Mail;
use Stripe;
use Session;
use Stevebauman\Location\Facades\Location;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use App\Mail\ExceptionOccured;
use Throwable;


class FrontPaypalController extends Controller
{
    public function index(Request $request){
        if($request->license != "undefined"){
            if($request->license == "single" || $request->license == "multi" || $request->license == "enterp" ){
                $license = $request->license;
                $report_details = Arm_reports::where('status', 'active')->where('id', $request->id)->first();
                if(empty($report_details)){
                    return redirect('/404');
                }
                return view('front.payment', compact('license','report_details'));
            } else {
                return redirect('/404');
            }
        }else{
            return redirect()->back()->with('error', 'Choose Atleas One License Type');
        }
    }

    public function payment(Request $request)
    {
        $request->session()->flush();
        $request->validate([
            'license' => 'required',
            'user_name' =>'required',
            'user_email' =>'required',
            'user_mobile' =>'required',
        ]);

        $report_details = Arm_reports::where('status', 'active')->where('id', $request->id)->first();
        if(empty($report_details)){
            return redirect('/404');
        }
        $input['report_id'] = $request->id;
        $input['report_name'] = $report_details->title;
        $input['report_slug'] = $report_details->url;
        $input['report_price'] = $report_price = $this->report_price($report_details, $request->license);
        $input['license_type'] = $request->license;
        $input['user_name'] = $request->user_name;
        $input['user_email'] = $request->user_email;
        $input['user_mobile'] = '+'.$request->country_code.$request->user_mobile;
        $input['payment_method'] = $request->payment_method;
        $currentUserInfo = $request->ip() != "127.0.0.1" ? Location::get($request->ip()) : false;
        $input['country'] = $currentUserInfo ? $currentUserInfo->countryName : '' ;
        $input['payment_status'] = "pending";
        Session::push('user_inputs',$input);

        // paypal code here
        if(isset($request->payment_method) && $request->payment_method == "paypal"){
            try{
                $provider = new Paypal;
                $provider->setApiCredentials(config('paypal'));
                $paypalToken = $provider->getAccessToken();
            } catch (Throwable $e) {
                return redirect()->back()->with('error', 'Check Your Network Connnection or Try Again Later');
            } 

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('payment_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $report_price
                        ],
                    ]
                ]
            ]);
            if(isset($response['id']) && $response['id'] != null){
                foreach($response['links'] as $link){
                    if($link['rel'] == "approve"){
                        $input['created_by'] = $request->user_email;
                        $input['created_ip_address'] = $request->ip();
                        Arm_payment_detail::create($input);
                        try{
                            Mail::to('noreply@analyticsmarketresearch.com')->send(new mailToAdminBeforePayment($input));
                        } catch (Throwable $e) {
                            return true;
                        } 
                        return redirect()->away($link['href']);
                    }
                }
            }else{
                return redirect()->route('payment_cancel');
            }
        }

        // stripe code here
        if(isset($request->payment_method) && $request->payment_method == "stripe"){

            try{
                \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SK'));
            
                $response = \Stripe\Checkout\Session::create ([
                    'line_items' =>[
                        [
                            "price_data" => [
                                "currency" => "usd",
                                "product_data" => [
                                    'name' => $input['report_name'],
                                    'description' => "REPORT FORMAT: PPT, PDF, WORD, EXCEL",
                                ],
                                "unit_amount" => $report_price * 100,
                            ],
                            "quantity" => 1,
                        ]
                    ],
                    "mode" => "payment",
                    "success_url" => route('stripe_success')."?session_id={CHECKOUT_SESSION_ID}",
                    "cancel_url" => route('payment_cancel'),
                ]);
            } catch (Throwable $e) {
                return redirect()->back()->with('error', 'Check Your Network Connnection or Try Again Later');
            } 
            if($response->status == "open"){
                $input['created_by'] = $request->user_email;
                $input['created_ip_address'] = $request->ip();
                Arm_payment_detail::create($input);
                try{
                    Mail::to('noreply@analyticsmarketresearch.com')->send(new mailToAdminBeforePayment($input)); // Mail to Admin
                } catch (Throwable $e) {
                    return true;
                } 
            }
            return redirect()->away($response->url);
        }
    }

    public function paypal_success(Request $request){
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        $order_details = $provider->showOrderDetails($response['id']);
        if(isset($order_details['status']) && $order_details['status'] == 'COMPLETED'){
            $user_inputs = Session::get('user_inputs');
            Session::forget('user_inputs');
            $payment_id = $order_details['purchase_units'][0]['payments']['captures'][0]['id'];
            $report_price = $user_inputs[0]['report_price'];
            $input['modified_by'] = $user_inputs[0]['user_email'];
            $input['modified_ip_address'] = $request->ip();
            $user_inputs[0]['payment_status'] = $input['payment_status'] = "paid";
            $user_inputs[0]['payment_id'] = $input['payment_id'] = $payment_id;

            Arm_payment_detail::where('user_email', $user_inputs[0]['user_email'])->where('payment_method', $user_inputs[0]['payment_method'])->where('report_id', $user_inputs[0]['report_id'])->where('payment_status', "pending")->update($input);
            try{
                Mail::to('noreply@analyticsmarketresearch.com')->send(new mailToadminAfterPayment($user_inputs)); // Mail to Admin
                Mail::to($user_inputs[0]['user_email'])->send(new mailToUserAfterPayment($user_inputs)); // Mail to user
            } catch (Throwable $e) {
                return true;
            } 
            return view("front.payment-successful", compact('report_price', 'payment_id'));
        }else{
            return redirect()->route('payment_cancel');
        }
    }

    public function stripe_success(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SK'));
        $session_id = $request->get(key: 'session_id');
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        if(!$session){
            throw new NotFoundHttpException;
        }
        if($session->payment_status == "paid"){
            $user_inputs = Session::get('user_inputs');
            Session::forget('user_inputs');
            $report_price = $user_inputs[0]['report_price'];
            $input['modified_by'] = $user_inputs[0]['user_email'];
            $input['modified_ip_address'] = $request->ip();
            $user_inputs[0]['payment_status'] = $input['payment_status'] = "paid";
            $user_inputs[0]['payment_id'] = $input['payment_id'] = $payment_id =  $session->payment_intent;
            Arm_payment_detail::where('user_email', $user_inputs[0]['user_email'])->where('payment_method', $user_inputs[0]['payment_method'])->where('report_id', $user_inputs[0]['report_id'])->update($input);
            try{
                Mail::to('noreply@analyticsmarketresearch.com')->send(new mailToadminAfterPayment($user_inputs)); // Mail to Admin
                Mail::to($user_inputs[0]['user_email'])->send(new mailToUserAfterPayment($user_inputs)); // Mail to user
            } catch (Throwable $e) {
                return true;
            } 
            return view("front.payment-successful", compact('report_price', 'payment_id'));
        }else{
            return redirect()->route('payment_cancel');
        }
    }

    public function payment_cancel(){
        $user_inputs = Session::get('user_inputs');
        Mail::to('noreply@analyticsmarketresearch.com')->send(new mailToAdminAfterPaymentCancel($user_inputs)); // Mail to Admin
        Mail::to($user_inputs[0]['user_email'])->send(new mailToUserAfterPaymentCancel($user_inputs)); // Mail to user
        return view('front.request_form.payment-cancel');
    }

    public function report_price($report_details, $license){
        if($license == "single"){
            return $report_details->single_user_cost;
        }
        if($license == "multi"){
            return  $report_details->multi_user_cost;
        }
        if($license == "enterp"){
            return $report_details->enterprise_user_cost;
        }
    }

}
