<?php

namespace App\Http\Controllers\Admin\CMS\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_service_we_market_client_support;
use App\Traits\MediaTrait;
use App\Models\Arm_role_privilege;
use Auth;

class WeMarketClientSupportServiceController extends Controller
{

    use MediaTrait;

    public function index()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'we_market_client_support_view')){
            $service = Arm_service_we_market_client_support::where('status', '=', 'active')->first();
            return view('admin.cms.pages_content.services_we_market_client_support', compact('service'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
        
    }

    public function store(Request $request)
    {
        
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
     
        $id = $request->id;

        if ($request->section_id == '1') {
            if ($request->has('banner_image_path')) {
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/services');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                $input['banner_image_name'] = $original_name;
            }

            $input['banner_heading'] = $request->banner_heading;
            $input['description'] = $request->description;
            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'we_market_client_support_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_service_we_market_client_support::where('id', '=', $id)->update($input);
                    return redirect('/admin/services-we-market-client-support')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'we_market_client_support_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_service_we_market_client_support::create($input);
                    return redirect('/admin/services-we-market-client-support')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->section_id == '2') {
            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'we_market_client_support_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_service_we_market_client_support::where('id', '=', $id)->update($input);
                    return redirect('/admin/services-we-market-client-support')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'we_market_client_support_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_service_we_market_client_support::create($input);
                return redirect('/admin/services-we-market-client-support')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    }

    public function show()
    {
        $service = Arm_service_we_market_client_support::where('status', '=', 'active')->first();
        return view('front.we-market-client-support', compact('service'));
    }

}
