<?php

namespace App\Http\Controllers\Admin\CMS\terms_we_use;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_terms_of_use;
use App\Models\Arm_role_privilege;
use Auth;

class TermsWeUseController extends Controller
{
    public function index()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'terms_of_use_view')){
            $terms_we_use= Arm_terms_of_use::where('status', '=', 'active')->first();
            return view('admin.cms.terms_of_use.terms_of_use', compact('terms_we_use'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function store(Request $request)
    {

        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $id = $request->id;

        if ($request->has('privacy')) {
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'terms_of_use_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_terms_of_use::where('id', '=', $id)->update($input);
                    return redirect('admin/terms-of-use')->with('success', 'Terms of use updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'terms_of_use_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_terms_of_use::create($input);
                    return redirect('admin/terms-of-use')->with('success', 'Terms of use added successfully!');
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
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'terms_of_use_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_terms_of_use::where('id', '=', $id)->update($input);
                    return redirect('admin/privacy-policy')->with('success', 'Terms of use updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'terms_of_use_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_terms_of_use::create($input);
                    return redirect('admin/terms-of-use')->with('success', 'Terms of use banner added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    }

    public function show()
    {
        $terms_we_use = Arm_terms_of_use::where('status', '=', 'active')->first();
        return view('front.terms-of-use', compact('terms_we_use'));
    }

}
