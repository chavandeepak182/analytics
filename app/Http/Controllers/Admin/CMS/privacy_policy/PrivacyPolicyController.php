<?php

namespace App\Http\Controllers\Admin\CMS\privacy_policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_privacy_policy;
use App\Models\Arm_role_privilege;
use Auth;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'privacy_policy_view')){
            $privacy=Arm_privacy_policy::where('status','=','active')->first();
            return view('admin.cms.privacy_policy.privacy_policy',compact('privacy'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function store(Request $request){

        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $id = $request->id;

        if ($request->has('privacy')){
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'privacy_policy_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_privacy_policy::where('id', '=', $id)->update($input);
                    return redirect('admin/privacy-policy')->with('success', 'Privacy Policy updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'privacy_policy_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_privacy_policy::create($input);
                    return redirect('admin/privacy-policy')->with('success', 'Privacy Policy added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }


        if ($request->has('meta')) {

            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;


            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'privacy_policy_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_privacy_policy::where('id', '=', $id)->update($input);
                    return redirect('admin/privacy-policy')->with('success', 'Privacy Policy updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'privacy_policy_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_privacy_policy::create($input);
                    return redirect('admin/privacy-policy')->with('success', 'Privacy Policy added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    }

    public function show(){
        $privacy = Arm_privacy_policy::where('status', '=', 'active')->first(); 
        return view('front.privacy-policy',compact('privacy'));
    }

}
