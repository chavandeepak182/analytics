<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_role_privilege;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MediaTrait;
use Storage;
use Crypt;
use Arr;
use Str;
use DB;
use Session;

class RolesPrivilegesController extends Controller
{
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view')){
            return view('admin.roles-privileges.roles-privileges');
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function create(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_add')){
            return view('admin.roles-privileges.add-roles-privileges');
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function store(Request $request){
        // dd($request->all());
        $id = $request->role_id;

        $request->validate([
            'role_name' => 'required|string',
            'privileges' => 'required',
        ]);

        if (!empty($id)) {
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_edit')) {
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                $input['role_name'] = $request->role_name;
                $input['privileges'] = implode(',', $request->privileges);
                Arm_role_privilege::find($id)->update($input);
                return redirect('admin/roles-privileges')->with('success', 'Roles Updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {

            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_add')) {
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                $input['role_name'] = $request->role_name;
                $input['privileges'] = implode(',', $request->privileges);
                Arm_role_privilege::create($input);
                return redirect('admin/roles-privileges')->with('success', 'Roles Added Successfully!');
            } else {
                return redirect()->back()->with('error', 'Access Denied!!');
            }
        }
    }

    public function role_privileges_data_table(Request $request){
        $roles_previleges = Arm_role_privilege::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'role_name', 'privileges', 'status')->get();

        if ($request->ajax()) {
            return DataTables::of($roles_previleges)

                ->addIndexColumn()

                ->addColumn('role_name', function ($row) {
                    return !empty($row->role_name) ? $row->role_name : '' ;
                })
                ->addColumn('privileges', function ($row) {
                    return !empty($row->privileges) ? "<div class='scrollable-cell'>".implode(', ', explode(',',$row->privileges))."</div>" : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_edit')) {
                        $actionBtn .= '<a href="' . url('admin/roles-privileges/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_delete')) {
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="arm_role_privileges" data-flash="User Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_status_change')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_role_privileges" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_role_privileges" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['action', 'status', 'privileges'])
                ->make(true);
        }
    }

    public function edit($id){
        try {
            $role_privileges = Arm_role_privilege::find(Crypt::decrypt($id));
            return view('admin.roles-privileges.add-roles-privileges', compact('role_privileges'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/roles-privileges')->with('error', 'Access Denied !');
        }
    }
}
