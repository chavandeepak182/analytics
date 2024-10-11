<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_visual_setting;
use App\Models\Arm_role_privilege;
use App\Traits\MediaTrait;
use Auth;

class VisualSettings extends Controller
{
    use MediaTrait;
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_view')){
            $visual_settings = Arm_visual_setting::where('status', 'active')->first();
            return view('admin.settings.visual_settings', compact('visual_settings'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){
        // dd($request->all());
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $request->validate([
            'logo_image_path' => 'max:2048',
            'mini_logo_image_path' => 'max:2048',         
            'logo_email_image_path' => 'max:2048',
            'favicon_image_path' => 'max:2048',
        ]);

        $id = $request->id;

        if ($request->has('logo_image_path')){
            $input['logo_image_path'] = $this->verifyAndUpload($request, 'logo_image_path', 'images/visuals');
            $original_name = $request->file('logo_image_path')->getClientOriginalName();
            $input['logo_image_name'] = $original_name;
        }

        if ($request->has('mini_logo_image_path')){
            $input['mini_logo_image_path'] = $this->verifyAndUpload($request, 'mini_logo_image_path', 'images/visuals');
            $original_name = $request->file('mini_logo_image_path')->getClientOriginalName();
            $input['mini_logo_image_name'] = $original_name;
        }

        if ($request->has('logo_email_image_path')){
            $input['logo_email_image_path'] = $this->verifyAndUpload($request, 'logo_email_image_path', 'images/visuals');
            $original_name = $request->file('logo_email_image_path')->getClientOriginalName();
            $input['logo_email_image_name'] = $original_name;
        }

        if ($request->has('favicon_image_path')){
            $input['favicon_image_path'] = $this->verifyAndUpload($request, 'favicon_image_path', 'images/visuals');
            $original_name = $request->file('favicon_image_path')->getClientOriginalName();
            $input['favicon_image_name'] = $original_name;
        }

        if(!empty($id)){
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'visual_setting_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_visual_setting::where('id', $id)->update($input);
                return redirect('admin/visual-settings')->with('success', 'Visual Settings updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'visual_setting_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_visual_setting::create($input);
                return redirect('admin/visual-settings')->with('success', 'Visual Settings added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
    }
}
