<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\Admins;
use App\Models\EmailSettings;
use App\Mail\OTP;
use App\Models\Arm_reports;
use DB;
use File;
use Response;

class LoginController extends Controller
{
    //show login form
    public function index(){ 
        return !empty(Session::has('LocalSuperMartAdmin*%')) ? redirect('admin/dashboard') :  view('admin.login.login'); 
    }

    public function dashboard_view()
    {
        $totalReportCount = Arm_reports::where('status', '!=', 'delete')->count();
        $totalTopSellingReportCount = Arm_reports::where('status', '!=', 'delete')->where('top_selling', 'yes')->count();
        $totaUpcomingReportCount = Arm_reports::where('status', '!=', 'delete')->where('upcoming_report', 'yes')->count();
        return !empty(Session::has('LocalSuperMartAdmin*%')) ? view('admin.dashboard',compact('totalReportCount','totalTopSellingReportCount','totaUpcomingReportCount')) : redirect('/');        
    }

    public function admin_login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );  
        // login by Auth
        $user = Admins::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        if($user && Hash::check($user_data['password'], $user->password)){
            Auth::guard('arm_admins')->login($user);
            if(Auth::guard('arm_admins')->user()->status != 'active'){
                Auth::logout();
                Session::flush();
                return redirect('/admin')->with('error', 'Contact To Admin For Login');
            }else{
                $user_id = Auth::guard('arm_admins')->user()->id;  
                $last_login = Admins::where('id', $user_id)->update([
                    'last_login' => date('Y-m-d H:i:s'),
                ]);
                Session::put('LocalSuperMartAdmin*%', $user_id);
                return redirect('admin/dashboard')->with('success','Login Successfully!');
            }
        }else{          
            return redirect('/admin')->with('error','Invalid Login Details!');;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/admin')->with('success', 'Logout Successfully!');
    }

    public function view_change_password(){
        return view('admin.settings.change_password');
    }

    public function change_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required'
        ]);

        if(strcmp($request->new_password, $request->confirm_password) != 0){
            return redirect('admin/change-password')->with('error', 'The new password confirmation does not match.');
        }
        
        $user_data = array(
            'email' => Auth::guard('arm_admins')->user()->email,
            'password' => $request->get('old_password')
        );  
        
        $user = Admins::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        if($user && Hash::check($user_data['password'], $user->password)){
            Auth::guard('arm_admins')->login($user);
            if(Auth::guard('arm_admins')->user()->status != 'active'){
                Auth::logout();
                Session::flush();
                return redirect('admin/change-password')->with('error', 'Contact To Admin For Login');
            }else{
                $user = Admins::where('email', $user_data['email'])->update(['password' => Hash::make($request->new_password)]);
                $user_id = Auth::guard('arm_admins')->user()->id;  
                $last_login = Admins::where('id', $user_id)->update([ 'last_login' => date('Y-m-d H:i:s')]);
                Session::put('LocalSuperMartAdmin*%', $user_id);
                return redirect('admin/change-password')->with('success','Password Change Successfully!');
            }
        }else{          
            return redirect('/admin/change-password')->with('error','Invalid Old Pasword !');;
        }
    }
}
