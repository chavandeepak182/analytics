<?php

namespace App\Http\Controllers\Admin\CMS\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_home;
use App\Traits\MediaTrait;
use App\Models\Arm_testimonial;
use App\Models\Arm_client_logo;
use App\Models\Arm_home_page_banner;
use App\Models\Arm_blog;
use App\Models\Arm_reports;
use App\Models\Arm_role_privilege;
use Auth;


class HomeController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'home_page_view')){
            $home = Arm_home::where('status', '=', 'active')->first();
            $logo = Arm_client_logo::where('status', '=', 'active')->get();
            $banner=Arm_home_page_banner::where('status', '=', 'active')->get();
            return view('admin.cms.pages_content.homepage', compact('home','logo','banner'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
        
    }

    public function page_content(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view')){
            return view('admin.cms.pages_content.page_content');
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function store(Request $request)
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        
        $id = $request->id;
        
        if ($request->has('section_1')) {
            $request->validate([
                'section_1_heading' => 'required',
                'section_1_sub_heading' => 'required',
                'section_1_banner_content' => 'required',
                'section_1_link' => 'required',
                'section_1_respondents' => 'required|numeric',
                'section_1_app_partners' => 'required|numeric',
                'section_1_targeted_globally' => 'required|numeric',
            ]);
            $images = $request->file('section_1_banner_image_path');
            if ($request->hasFile('section_1_banner_image_path')){
                foreach ($images as $image) {
                    $banner_image = new Arm_home_page_banner();
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $original_name = $image->getClientOriginalName();
                    $filePath = $image->storeAs('public/images/home', $filename);
                    $banner_image['image_path'] = $filePath;
                    $banner_image['image_name'] = $original_name;
                    $banner_image['created_by'] =  auth()->guard('arm_admins')->user()->id;
                    $banner_image['created_ip_address'] = $request->ip();
                    $banner_image->save();
                }
            }
             
            $input['section_1_heading'] = $request->section_1_heading;
            $input['section_1_sub_heading'] = $request->section_1_sub_heading;
            $input['section_1_banner_content'] = $request->section_1_banner_content;
            $input['section_1_link'] = $request->section_1_link;
            $input['section_1_respondents'] = $request->section_1_respondents;
            $input['section_1_app_partners'] = $request->section_1_app_partners;
            $input['section_1_targeted_globally'] = $request->section_1_targeted_globally;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
                
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_2')) {
            $request->validate([
                'section_2_heading' => 'required',
                'section_2_description' => 'required',
            ]);

            if ($request->has('section_2_image_path')) {
                $input['section_2_image_path'] = $this->verifyAndUpload($request, 'section_2_image_path', 'images/home');
                $original_name = $request->file('section_2_image_path')->getClientOriginalName();
                $input['section_2_image_name'] = $original_name;
            }
            $input['section_2_heading'] = $request->section_2_heading;
            $input['section_2_description'] = $request->section_2_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'updated successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'About us banner added successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_3')) {
            $request->validate([
                'section_3_heading' => 'required',
                'section_3_description' => 'required',
            ]);
            if ($request->has('section_3_image_path')) {
                $input['section_3_image_path'] = $this->verifyAndUpload($request, 'section_3_image_path', 'images/home');
                $original_name = $request->file('section_3_image_path')->getClientOriginalName();
                $input['section_3_image_name'] = $original_name;
            }
            $input['section_3_heading'] = $request->section_3_heading;
            $input['section_3_description'] = $request->section_3_description;


            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_4')) {
            $request->validate([
                'section_4_heading' => 'required',
                'section_4_title_1' => 'required',
                'section_4_description_1' => 'required',
                'section_4_title_2' => 'required',
                'section_4_description_2' => 'required',
                'section_4_title_3' => 'required',
                'section_4_description_3' => 'required',
                'section_4_title_4' => 'required',
                'section_4_description_4' => 'required',
            ]);
            if ($request->has('section_4_image_1_path')) {
                $input['section_4_image_1_path'] = $this->verifyAndUpload($request, 'section_4_image_1_path', 'images/home');
                $original_name = $request->file('section_4_image_1_path')->getClientOriginalName();
                $input['section_4_image_1_name'] = $original_name;
            }
            if ($request->has('section_4_image_2_path')) {
                $input['section_4_image_2_path'] = $this->verifyAndUpload($request, 'section_4_image_2_path', 'images/home');
                $original_name = $request->file('section_4_image_2_path')->getClientOriginalName();
                $input['section_4_image_2_name'] = $original_name;
            }

            $input['section_4_heading'] = $request->section_4_heading;
            $input['section_4_title_1'] = $request->section_4_title_1;
            $input['section_4_description_1'] = $request->section_4_description_1;
            $input['section_4_title_2'] = $request->section_4_title_2;
            $input['section_4_description_2'] = $request->section_4_description_2;
            $input['section_4_title_3'] = $request->section_4_title_3;
            $input['section_4_description_3'] = $request->section_4_description_3;
            $input['section_4_title_4'] = $request->section_4_title_4;
            $input['section_4_description_4'] = $request->section_4_description_3;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_5')) {
            $request->validate([
                'section_5_heading' => 'required',
                'section_5_title_1' => 'required',
                'section_5_description_1' => 'required',
                'section_5_title_2' => 'required',
                'section_5_description_2' => 'required',
                'section_5_title_3' => 'required',
                'section_5_description_3' => 'required',
            ]);
            $input['section_5_heading'] = $request->section_5_heading;
            $input['section_5_title_1'] = $request->section_5_title_1;
            $input['section_5_description_1'] = $request->section_5_description_1;
            $input['section_5_title_2'] = $request->section_5_title_2;
            $input['section_5_description_2'] = $request->section_5_description_2;
            $input['section_5_title_3'] = $request->section_5_title_3;
            $input['section_5_description_3'] = $request->section_5_description_3;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('section_6')) {
            $request->validate([
                'section_6_heading'  => 'required',
                'section_6_description' => 'required',
            ]);
            $input['section_6_heading'] = $request->section_6_heading;
            $input['section_6_description'] = $request->section_6_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }

        if ($request->has('meta')) {
            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_home::where('id', '=', $id)->update($input);
                    return redirect('admin/homepage')->with('success', 'Updated Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_home::create($input);
                    return redirect('admin/homepage')->with('success', 'Added Successfully!');
                }else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        }
    }

    public function show()
    {
        $home = Arm_home::where('status', 'active')->first();
        $logo = Arm_client_logo::where('status', 'active')->get();
        $testimonials = Arm_testimonial::where('status', 'active')->get();
        $banner = Arm_home_page_banner::where('status', 'active')->get();
        $blogs = Arm_blog::where('status', 'active')->get();
        $latestBlogs=Arm_blog::where('type', 'blogs')->where('status', 'active')->latest('created_at')->take(3)->get();
        $pressRelease = Arm_blog::where('status', '=', 'active')->where('type','=','press_release')->get();
        $topSellingReports = Arm_reports::where('status', '=', 'active')->where('top_selling', 'yes')->get();
        return view('front.index', compact('home', 'testimonials','logo','banner','blogs','topSellingReports','pressRelease','latestBlogs'));
    }

    

    public function store_client_logo(Request $request){
        $images = $request->file('image_path');
        if ($request->hasFile('image_path')){
            foreach ($images as $image) {
                $client_logo = new Arm_client_logo(); 
                $filename =time() . '_' . $image->getClientOriginalName();
                $original_name = $image->getClientOriginalName();
                $filePath = $image->storeAs('public/images/client_logo', $filename);
                $client_logo['image_path'] =$filePath;
                $client_logo['image_name'] = $original_name;
                $client_logo['modified_by'] =  auth()->guard('arm_admins')->user()->id;
                $client_logo['created_ip_address'] = $request->ip();
                $client_logo->save();
            }
        }
        $logo = Arm_client_logo::where('status', '=', 'active')->get();
        $home = Arm_home::where('status', '=', 'active')->first();
        $banner = Arm_home_page_banner::where('status', '=', 'active')->get();
        return view('admin.cms.pages_content.homepage', compact('home','logo','banner'));
    }

    public function delete_client_logo(Request $request)
    {
        if ($request->ajax()) {
            if ($request->client_logo_id != '') {
                $client_logo = Arm_client_logo::where('id',$request->client_logo_id)->update(['status' => 'delete']);

                $response = [];

                if (!empty($client_logo)){
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


    public function delete_banner_image(Request $request)
    {
        if ($request->ajax()) {
            if ($request->banner_image_id!= ''){
                $banner_image = Arm_home_page_banner::where('id', $request->banner_image_id)->update(['status' => 'delete']);

                $response = [];

                if (!empty($banner_image)){
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

    public function test(Request $request){
        return redirect('/')->with("success","hello");
    }
}
