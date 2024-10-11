<?php

namespace App\Http\Controllers\Admin\CMS\career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_career;
use App\Models\Arm_openings;
use App\Models\Arm_role_privilege;
use Yajra\DataTables\DataTables;
use Auth;
use Crypt;
use Arr;
use Illuminate\Support\Facades\Crypt as FacadesCrypt;
use Storage;

class CareerController extends Controller
{
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_view')){
            $career=Arm_career::where('status','=','active')->first();
            return view('admin.careers.careers',compact('career'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $id=$request->id;
        $input['heading'] = $request->heading;
        $input['description'] = $request->description;

        if (!empty($id)) {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_career::where('id', '=', $id)->update($input);
                return redirect('/admin/careers')->with('success', 'Career updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_career::create($input);
                return redirect('/admin/careers')->with('success', 'Career added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
    }

    public function show(){
        $career = Arm_career::where('status', '=','active')->first();
        $openings = Arm_openings::where('status', '=','active')->orderBy('id', 'DESC')->get();
        return view('front.careers', compact('career','openings'));
    }

    public function store_job_openings(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        $id=$request->id;

        $input['heading'] = $request->heading;
        $input['experience'] = $request->experience;
        $input['number_of_positions'] = $request->number_of_positions;
        $input['location'] = $request->location;

        if (!empty($id)) {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_openings::where('id', '=', $id)->update($input);
                return redirect('/admin/careers')->with('success', 'Careers position updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_openings::create($input);
                return redirect('/admin/careers')->with('success', 'Careers position added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
    }

    public function  data_table(Request $request)
    {
        
        $openings = Arm_openings::where('status', '!=', 'delete')
        ->select('id', 'heading', 'experience', 'number_of_positions', 'location', 'status')
        ->get();
       
        if ($request->ajax()) {

            return DataTables::of($openings)
                ->addIndexColumn()

                ->addColumn('heading', function ($row) {
                    if (!empty($row->heading)){
                        return ucfirst($row->heading);
                    }
                })

                ->addColumn('number_of_positions', function ($row){
                    if (!empty($row->number_of_positions)) {
                        return ucfirst($row->number_of_positions);
                    }
                })

                ->addColumn('experience', function ($row) {
                    if (!empty($row->experience)) {
                        return ucfirst($row->experience);
                    }
                })

                ->addColumn('location', function ($row){
                    if (!empty($row->location)) {
                        return ucfirst($row->location);
                    }
                })

                
                ->addColumn('action', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    $actionBtn = '';
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_edit')){
                        $actionBtn .= '<a href="' . url('admin/openings/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_career_openings" data-flash="Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id. '" data-table="arm_career_openings" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id. '" data-table="arm_career_openings" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    } else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    }
                })

                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    } 

    public function edit(Request $request){
        try{
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'careers_edit')){
                $openings=Arm_openings::where('id', Crypt::decrypt($request->id))->first();
                $career = Arm_career::where('status', 'active')->first();
                return view('admin.careers.careers', compact('career','openings'));
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/testimonial')->with('error', 'Access Denied !');
        }
        
    }

    public function form_heading(Request $request){
        $id=$request->id;
        $openings_heading= Arm_openings::where('id', '=', $id)->select('heading')->first();
        if (!empty($openings_heading)) {
            return response()->json(['message' => 'Data Fetched Successfully.', 'status' => 'true', 'data' =>  $openings_heading]);
        } else {
            return response()->json(['message' => 'Data not found.', 'status' => 'true', 'data' => '']);
        }
    }
}
