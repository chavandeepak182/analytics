<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Mail\OTP;
use Mail;
use Hash;
use Session;
use DB;
use Config;

class ForgotController extends Controller
{
    
    public function forgot_password_view(Request $request){
        $request->session()->forget('email'); 
        return view('admin.login.forgot-password');
    }

    public function send_otp(Request $request){
        $validator = $request->validate([
            'email' => 'required|email'
        ]);
        if($validator)
        {
            $check_email = strtolower($request->email);
            $verified_email = Admin::where('email','=',$check_email)->first(); 
          
       
            if($verified_email)
            {
                $otp = rand(1111,9999);
                $save_otp = Admin::where('email','=',$check_email)->update(['otp'=>$otp]);
                
                \Mail::to($check_email)->send(new OTP($otp));
                $request->session()->put('email',$check_email);
                return redirect('admin/check-otp')->with('success', 'OTP sent successfully!');
            }                
        }         
        return redirect('admin/check-otp')->with('error', 'Enter valid email.');
        
    }


    public function otp_verify(Request $request){
        $validator = $request->validate([
            'otp' => 'required|numeric|digits:4',
        ]);

        if($validator){
            $check_otp = Admin::where('otp','=',$request->otp)->value('otp');
           
            if($check_otp){
                return redirect('admin/reset-password')->with('success','OTP verified successfully.');
            }
            else{
                $request->session()->forget('email');          
                return redirect('admin/forgot-password')->with('error','OTP did not matched');
                
            }
        }
        $request->session()->forget('email'); 
    }

    public function reset_password_view(){
        $email = session('email');
        if(empty($email))
        {
            return redirect('admin');
        }
        else
        {
            return view('admin/login/reset-password');
        }
    }

    public function reset_password(Request $request)
    {
        $email = session('email'); 
        $validator = $request->validate([
            'new_password' => 'Required|min:8',
            'confirm_password' => 'Required|same:new_password|min:8'
        ]);
    
        if($validator)
        {   
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;   
            if($new_password == $confirm_password)
            {
                $password = Hash::make($confirm_password);
                Admin::where('email',$email)->update(['password'=> $password]);
                Session::flush();
                return redirect('admin')->with('success', 'Password changed successfully!');;
            }
            else
            {
                return redirect()->back();
            }
        } 
        else
        {
            return redirect()->back();
        }   
    }
}
