<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Master\Cities;
use App\Models\Master\States;
use App\Models\Master\Area;
use App\Models\Master\Unit;

class BaseController extends Controller
{
    public function delete(Request $request)
    {
        $data = DB::table($request->table)->where('id', $request->id)->update([
            'status' => 'delete',
            'modified_by' => Auth::guard('arm_admins')->user()->id,
            'modified_ip_address' => $_SERVER['REMOTE_ADDR']
        ]);
        return response()->json(['message' => $request->flash, 'status' => 'true']);
    }

    public function status(Request $request)
    {

        $status = DB::table($request->table)->where('id', $request->id)->value('status');
        
        if ($status == 'active') {
            $block_status = DB::table($request->table)->where('id', $request->id)->update([
                'status' => 'inactive',
                'modified_by' => Auth::guard('arm_admins')->user()->id,
                'modified_ip_address' => $_SERVER['REMOTE_ADDR']
            ]);
            $user_status = "inactive";
        } 
        else 
        {
            $active_status = DB::table($request->table)->where('id', $request->id)->update([
                'status' => 'active',
                'modified_by' => Auth::guard('arm_admins')->user()->id,
                'modified_ip_address' => $_SERVER['REMOTE_ADDR']
            ]);
            $user_status = "active";
        }
        return response()->json(['message' => $request->flash, 'user_status' => $user_status, 'status' => 'true']);
    }

    public function status_about_us_section_3(Request $request)
    {
        $status = DB::table($request->table)->where('id', $request->id)->value('section_3_image_status');
        if ($status == 'active') {
            $block_status = DB::table($request->table)->where('id', $request->id)->update([
                'section_3_image_status' => 'inactive',
                'modified_by' => Auth::guard('admin')->user()->id,
                'modified_ip_address' => $_SERVER['REMOTE_ADDR']
            ]);
        } else {
            $active_status = DB::table($request->table)->where('id', $request->id)->update([
                'section_3_image_status' => 'active',
                'modified_by' => Auth::guard('admin')->user()->id,
                'modified_ip_address' => $_SERVER['REMOTE_ADDR']
            ]);
        }
        return response()->json(['message' => $request->flash, 'status' => 'true']);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    // public function state_list(Request $request)
    // {
    //     if($request->ajax()){
    //         $states = States::where('status','active')->where('country_id',$request->country_id)->select('id','state_name')->orderBy('id', 'DESC')->get();
        
    //         $html = '';
    //         $html .= '<option value="" disabled selected>Select State</option>';

    //         if (!empty($states)) {
    //             foreach ($states as $city_data) {
    //                 $html .= '<option value="' . $city_data->id . '">' . $city_data->state_name . '</option>';
    //             }
    //         }
    //         return response()->json(['status' => 'true', 'html' => $html]);
    //     }else{
    //         return 'No direct scripts are allowed';
    //     }
    // }

    // public function city_list(Request $request)
    // {
    //     if($request->ajax()){
    //         $cities = Cities::where('status','active')->where('state_id',$request->state_id)->select('id','city_name')->orderBy('id', 'DESC')->get();
        
    //         $html = '';
    //         $html .= '<option value="" disabled selected>Select City</option>';

    //         if (!empty($cities)) {
    //             foreach ($cities as $city_data) {
    //                 $html .= '<option value="' . $city_data->id . '">' . $city_data->city_name . '</option>';
    //             }
    //         }
    //         return response()->json(['status' => 'true', 'html' => $html]);
    //     }else{
    //         return 'No direct scripts are allowed';
    //     }
    // }

    // public function area_list(Request $request)
    // {
    //     if($request->ajax()){
    //         $area = Area::where('status','active')->where('city_id',$request->city_id)->select('id','area_name')->orderBy('id', 'DESC')->get();
        
    //         $html = '';
    //         $html .= '<option value="" disabled selected>Select Area</option>';

    //         if (!empty($area)) {
    //             foreach ($area as $area_data) {
    //                 $html .= '<option value="' . $area_data->id . '">' . $area_data->area_name . '</option>';
    //             }
    //         }
    //         return response()->json(['status' => 'true', 'html' => $html]);
    //     }else{
    //         return 'No direct scripts are allowed';
    //     }
    // }

    // public function unit_list(Request $request)
    // {
    //     if($request->ajax()){
    //         $units = Unit::where('status','active')->select('id','unit')->orderBy('id', 'DESC')->get();
        
    //         $html = '';
    //         $html .= '<option value="" disabled selected>Select Unit</option>';

    //         if (!empty($units)) {
    //             foreach ($units as $unit_data) {
    //                 $html .= '<option value="' . $unit_data->id . '">' . $unit_data->unit . '</option>';
    //             }
    //             return response()->json(['status' => 'true', 'response' => $html]);
    //         }else{                
    //             return response()->json(['status' => 'false', 'response' => 'No unit found']);
    //         }
    //     }else{
    //         return 'No direct scripts are allowed';
    //     }
    // }
}