<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_email_setting;
use App\Models\Arm_role_privilege;
use Auth;

class EmailSettings extends Controller
{
    public function index(){
        // return view('admin.settings.email_settings');
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'email_setting_view')){
            $email_settings = Arm_email_setting::where('status', 'active')->first();
            return view('admin.settings.email_settings', compact('email_settings'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){
        // dd($request->all());
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $request->validate([
            'mail_protocol' => 'required',
            'mail_title' => 'required',         
            'mail_host' => 'required',
            'mail_port' => 'required|numeric',
            'mail_encryption' => 'required',
            'mail_username' => 'required|email',
            'mail_password' => 'required',
        ]);

        $id = $request->id;

        $input['mail_protocol'] = $request->mail_protocol;
        $input['mail_title'] = $request->mail_title;
        $input['mail_host'] = $request->mail_host;
        $input['mail_port'] = $request->mail_port;
        $input['mail_encryption'] = $request->mail_encryption;
        $input['mail_username'] = $request->mail_username;
        $input['mail_password'] = $request->mail_password;
        
        if(!empty($id)){
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'email_setting_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_email_setting::where('id', $id)->update($input);
                return redirect('admin/email-settings')->with('success', 'Email Settings updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'email_setting_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_email_setting::create($input);
                return redirect('admin/email-settings')->with('success', 'Email Settings added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
    }
}
