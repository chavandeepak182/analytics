<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_enquiry;
use App\Models\Arm_reports;
use App\Models\ReportCategory;
use App\Mail\EnquiryMail;
use App\Models\Arm_general_settings;
use Mail;
use Validator;
use App\Mail\ContactThankYouMail;
use Stevebauman\Location\Facades\Location;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use App\Mail\ExceptionOccured;
use Throwable;

class FrontEnquiryController extends Controller
{
    public function index(Request $request){
        $request_slug = explode('/', url()->current())[3];
        foreach(config('constant.request_type_slug') as $key => $value){
            if($request_slug == $key){
                $request_type = $value;
                $report_details = Arm_reports::where('status','active')->where('id',$request->report_id)->first();
                if(empty($report_details)){
                    return redirect('/404');
                }
                $category_details = ReportCategory::where('status','active')->where('id',$report_details->category_id)->first();
                if(empty($category_details)){
                    return redirect('/404');
                }
                return view('front.request_form.request_form', compact('report_details', 'request_slug', 'request', 'request_type', 'category_details'));
            }
        }
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile_number' => 'required|numeric',
            'company_name' => 'max:100',
            'message' => 'max:1000',
            'captcha' => 'required|captcha',
        ],[
            'captcha.captcha' => 'Please Enter Correct Capcha',
        ]);

        $input['request_type'] = $request->request_type;
        $input['report_id'] = $request->report_id;
        $input['report_title'] = $request->report_title;
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['mobile_number'] = $request->mobile_number;
        $input['company_name'] = !empty($request->company_name)? $request->company_name:'';
        $input['message'] = $request->message;
        $input['created_by'] = "100";
        $input['created_ip_address'] = $request->ip();
        $currentUserInfo = $request->ip() != "127.0.0.1" ? Location::get($request->ip()) : false;
        $input['country'] = $currentUserInfo ? $currentUserInfo->countryName : '' ;

        if(!empty($request->report_id)){
            $report_details = Arm_reports::where('status','active')->where('id',$request->report_id)->first();
            if(empty($report_details)){
                return redirect('/404');
            }
            $report_url = url('/reports')."/".$report_details->url."/".$report_details->id;
        }else{
            $report_url = "";
        }

        $mailData = [
            'request_type' => $input['request_type'],
            'report_name' => $input['report_title'],
            'name' =>   $input['name'],
            'email' => $input['email'],
            'phone' =>  $input['mobile_number'],
            'message' => $input['message'],
            'company_name' => $input['company_name'],
            'ip_address' => $request->ip(),
            'report_url' => $report_url
        ];
        Arm_enquiry::create($input);
        
        $sales_email = Arm_general_settings::get('email')->first();
        try {
            if($request->request_type != "blog"){
                Mail::to($sales_email->email)->send(new EnquiryMail($mailData)); // Mail to Admin
            }
            if($request->request_type == "blog"){
                Mail::to('noreply@analyticsmarketresearch.com')->send(new EnquiryMail($mailData)); // Mail to Admin
            }
            Mail::to($input['email'])->send(new ContactThankYouMail($mailData));
        }catch (Throwable $e) {
            return redirect()->back()->with('warning', 'Thank You ! Your Request Reached To Us, Mail Not Send , Make Sure Email is Right Or Network Connection is Proper');
        }
        if(!empty($report_url)){
            return redirect('thank-you/'.$request->request_type.'/'.$report_details->url.'/'.$request->report_id);
        } else {
            return redirect('thankyou');
            // return redirect('research-reports/all')->with('success', 'Thank You! Your Request Reached To Us, Our Business expert will contact you soon.');
        }
    }

    public function thankyou(Request $request){
        $request_type = $request->request_type;
        $report_details = Arm_reports::where('status', 'active')->where('id',$request->report_id)->first();
        if(!empty($report_details)){
            $category_details = ReportCategory::where('status','active')->where('id',$report_details->category_id)->first();
            if(!empty($category_details)){
                return view('front.request_form.thankyou', compact('report_details', 'category_details', 'request_type'));
            } else {
                return redirect('/404');
            }
        } else {
            return redirect('/404');
        }
    }
}
