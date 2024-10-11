<?php

namespace App\Http\Controllers\Admin\CMS\research_methdology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_research_methodology;
use App\Models\Arm_research_methodology_banner;
use App\Traits\MediaTrait;
use App\Models\Arm_role_privilege;
use Auth;

class ResearchMethdologyController extends Controller
{
    use MediaTrait;
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'research_methodology_view')){
            $research=Arm_research_methodology::where('status','=','active')->first();
            $banner = Arm_research_methodology_banner::where('status', '=', 'active')->get();
            return view('admin.cms.pages_content.research_methodology',compact('research','banner'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
         
    }

    public function store(Request $request){
        
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
     
        $id = $request->id;

        if($request->has('section_1')){
            $input['section_1_heading'] = $request->section_1_heading;
            $input['section_1_description'] = $request->section_1_description;


            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_research_methodology::where('id', '=', $id)->update($input);
                    return redirect('admin/research-methodology')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_research_methodology::create($input);
                    return redirect('admin/research-methodology')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    

        if($request->has('section_2')){
            $input['section_2_heading'] = $request->section_2_heading;
            $input['section_2_description'] = $request->section_2_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_research_methodology::where('id', '=', $id)->update($input);
                    return redirect('admin/research-methodology')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_research_methodology::create($input);
                    return redirect('admin/research-methodology')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_3')) {
            $input['section_3_heading'] = $request->section_3_heading;
            $input['section_3_description'] = $request->section_3_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_research_methodology::where('id', '=', $id)->update($input);
                    return redirect('admin/research-methodology')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_research_methodology::create($input);
                    return redirect('admin/research-methodology')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_4')) {

            if ($request->has('section_4_image_path_1')) {
                $input['section_4_image_path_1'] = $this->verifyAndUpload($request, 'section_4_image_path_1', 'images/research_methodology');
                $original_name = $request->file('section_4_image_path_1')->getClientOriginalName();
                $input['section_4_image_name_1'] = $original_name;
            }

            if ($request->has('section_4_image_path_2')) {
                $input['section_4_image_path_2'] = $this->verifyAndUpload($request, 'section_4_image_path_2', 'images/research_methodology');
                $original_name = $request->file('section_4_image_path_2')->getClientOriginalName();
                $input['section_4_image_name_2'] = $original_name;
            }

            if ($request->has('section_4_image_path_3')) {
                $input['section_4_image_path_3'] = $this->verifyAndUpload($request, 'section_4_image_path_3', 'images/research_methodology');
                $original_name = $request->file('section_4_image_path_3')->getClientOriginalName();
                $input['section_4_image_name_3'] = $original_name;
            }


            if ($request->has('section_4_image_path_4')) {
                $input['section_4_image_path_4'] = $this->verifyAndUpload($request, 'section_4_image_path_4', 'images/research_methodology');
                $original_name = $request->file('section_4_image_path_4')->getClientOriginalName();
                $input['section_4_image_name_4'] = $original_name;
            }

            $input['section_4_heading'] = $request->section_4_heading;
            $input['section_4_description_1'] = $request->section_4_description_1;
            $input['section_4_description_2'] = $request->section_4_description_2;

            $input['section_4_sub_heading_1'] = $request->section_4_sub_heading_1;
            $input['section_4_sub_description_1'] = $request->section_4_sub_description_1;


            $input['section_4_sub_heading_2'] = $request->section_4_sub_heading_2;
            $input['section_4_sub_description_2'] = $request->section_4_sub_description_2;


            $input['section_4_sub_heading_3'] = $request->section_4_sub_heading_3;
            $input['section_4_sub_description_3'] = $request->section_4_sub_description_3;


            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_research_methodology::where('id', '=', $id)->update($input);
                    return redirect('admin/research-methodology')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_research_methodology::create($input);
                    return redirect('admin/research-methodology')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    }

    public function show(){
        $research = Arm_research_methodology::where('status', '=', 'active')->first();
        $banner = Arm_research_methodology_banner::where('status', '=', 'active')->get();
        return view('front.research-methodology',compact('research','banner'));
    }

    public function store_banner_image(Request $request)
    {
        //dd($request->all());
        $images = $request->file('image_path');
        if ($request->hasFile('image_path')){
            foreach ($images as $image){
                $banner_image = new Arm_research_methodology_banner();
                $filename = time() . '_' . $image->getClientOriginalName();
                $original_name = $image->getClientOriginalName();
                $filePath = $image->storeAs('public/images/research_methodology', $filename);
                $banner_image['image_path'] = $filePath;
                $banner_image['image_name'] = $original_name;
                $banner_image['modified_by'] =  auth()->guard('arm_admins')->user()->id;
                $banner_image['created_ip_address'] = $request->ip();
                $banner_image->save();
            }
        }
        $banner = Arm_research_methodology_banner::where('status', '=', 'active')->get();
        $research = Arm_research_methodology::where('status', '=', 'active')->first();
        return view('admin.cms.pages_content.research_methodology', compact('banner','research'));
    }

    public function delete_banner_image(Request $request)
    {
        if ($request->ajax()) {
            if ($request->banner_image_id != '') {
                $banner_image = Arm_research_methodology_banner::where('id', $request->banner_image_id)->update(['status' => 'delete']);

                $response = [];

                if (!empty($banner_image)) {
                    $response['status'] = 'true';
                    $response['message'] = 'Image deleted successfully.';
                } else {
                    $response['status'] = 'false';
                    $response['message'] = 'Image not deleted.';
                }
                return $response;
            }
        } else {
            return 'No direct scripts are allowed';
        }
    }

}
