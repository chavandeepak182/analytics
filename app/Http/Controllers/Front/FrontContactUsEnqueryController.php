<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_contact_us_query;
use Validator;
use Mail;
use App\Mail\ContactUsEnquery;
use App\Mail\ContactThankYouMail;
use Stevebauman\Location\Facades\Location;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use App\Mail\ExceptionOccured;
use Throwable;

class FrontContactUsEnqueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            $rules = [
                'fname' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|max:15',
            ]
        );
            
        $input['fname'] = $request->fname;
        $input['lname'] = $request->lname;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        $input['company_name'] = $request->company;
        $input['message'] = $request->message;
        $currentUserInfo = $request->ip() != "127.0.0.1" ? Location::get($request->ip()) : false;
        $input['country'] = $currentUserInfo ? $currentUserInfo->countryName : '' ;
        $input['created_ip_address'] = $request->ip();
        $data= Arm_contact_us_query::create($input);
        if(!empty($data)){
            $mailData = [
                'name' => $input['fname']." ".$input['lname'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'company_name' => $input['company_name'],
                'message' => $input['message'],
            ];
            $name= $input['fname'] .' '. $input['lname'];
            try{
                \Mail::to('noreply@analyticsmarketresearch.com')->send(new ContactUsEnquery($mailData));
                \Mail::to($input['email'])->send(new ContactThankYouMail($mailData));
            }catch(Throwable $e){
                return redirect()->back()->with('warning', 'Thank You ! Your Request Reached To Us, Mail Not Send , Make Sure Email is Right Or Network Connection is Proper');
            }
            // return redirect()->back()->with('success', 'Thank You ! Your Request Reached To Us');
            return redirect('/thankyou');
        }else {
            return redirect()->back()->with('error', 'Something Error');
        }
    }
}
