<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resolvers\PaymentPlatformResolver;

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

class FrontPaymentController extends Controller
{
    protected $paymentPlatformResolver;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    /**
     * Obtain a payment details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
        // $rules = [
        //     'value' => ['required', 'numeric', 'min:5'],
        //     'currency' => ['required', 'exists:currencies,iso'],
        //     'payment_platform' => ['required', 'exists:payment_platforms,id'],
        // ];

        // $request->validate($rules);

        $request->validate([
            'license' => 'required',
            'user_name' =>'required',
            'user_email' =>'required',
            'user_mobile' =>'required',
        ]);

        $report_details = Arm_reports::where('id', $request->id)->first();
        $input['report_id'] = $request->id;
        $input['report_name'] = $report_details->title;
        $input['report_slug'] = $report_details->url;
        $input['report_price'] = $report_price = $this->report_price($report_details, $request->license);
        $input['license_type'] = $request->license;
        $input['user_name'] = $request->user_name;
        $input['user_email'] = $request->user_email;
        $input['user_mobile'] = '+'.$request->country_code.$request->user_mobile;
        $input['payment_method'] = $request->payment_method;
        $input['payment_status'] = "pending";
        Session::push('user_inputs',$input);

        if(isset($request->payment_method) && $request->payment_method == "paypal"){
            $payment_platform = 1;
        }
        if(isset($request->payment_method) && $request->payment_method == "stripe"){
            $payment_platform = 2;
        }

        $paymentPlatform = $this->paymentPlatformResolver->resolveService($payment_platform);
        session()->put('paymentPlatformId', $payment_platform);

        // if ($request->user()->hasActiveSubscription()) {
        //     $request->value = round($request->value * 0.9, 2);
        // }

        return $paymentPlatform->handlePayment($request, $report_price);
    }

    public function approval()
    {
        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }

        return redirect()
            ->route('home')
            ->withErrors('We cannot retrieve your payment platform. Try again, please.');
    }

    public function cancelled()
    {
        return redirect()
            ->route('home')
            ->withErrors('You cancelled the payment.');
    }

    public function report_price($report_details, $license){
        if($license == "single"){
            return $report_details->single_user_cost;
        }
        if($license == "multi"){
            return  $report_details->multi_user_cost;
        }
        if($license == "enterprise"){
            return $report_details->enterprise_user_cost;
        }
    }
}
