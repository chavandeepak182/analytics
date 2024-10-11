<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Admins;
use App\Models\Arm_role_privilege;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MediaTrait;
use App\Mail\MailToAdminAfterUserCreation;
use App\Mail\MailToUserAfterUserCreation;
use Storage;
use Crypt;
use Session;

class SystemUserController extends Controller
{
    use MediaTrait;
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_view')){
            return view('admin.roles-privileges.system-user-list');
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function create(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_add')){
            $all_roles = Arm_role_privilege::where('id', '!=', '1')->where('status', 'active')->orderBy('id', 'DESC')->get();
            return view('admin.roles-privileges.add-system-user', compact('all_roles'));
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
        
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'mobile_no.' => 'numeric',
            'image_path' => 'max:2048'
        ]);
        // dd($request->all());

        $input['user_name'] = $request->name;
        $input['email'] = $request->email;
        $input['role_id'] = $request->role;
        $input['mobile_no'] = $request->mobile_no;
        $input['address'] = $request->address;
        
        if (!empty($id)) {
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_edit')) {
                if ($request->has('image_path')) {
                    $input['user_profile_image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/profile_images');
                    $original_name = $request->file('image_path')->getClientOriginalName();
                    $input['user_profile_image_name'] = $original_name;
                }

                // $input['password'] = Hash::make($request->password);
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Admins::find($id)->update($input);
                return redirect('admin/system-user-list')->with('success', 'User List Updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {
            $request->validate([
                'password' => 'required|min:8',
            ]);

            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_add')) {
                if ($request->has('image_path')) {
                    $input['user_profile_image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/profile_images');
                    $original_name = $request->file('image_path')->getClientOriginalName();
                    $input['user_profile_image_name'] = $original_name;
                }

                $input['password'] = Hash::make($request->password);
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Admins::create($input);
                $role_name = Arm_role_privilege::where('status', 'active')->where('id', $request->role)->orderBy('id', 'DESC')->first();
                $mailData = [
                    'name' => $input['user_name'],
                    'email' => $input['email'],
                    'phone' => $input['mobile_no'],
                    'password' => $request->password,
                    'role' => $role_name->role_name,
                ];
                try{
                    \Mail::to('noreply@wemarketresearch.com')->send(new MailToAdminAfterUserCreation($mailData));
                    \Mail::to($input['email'])->send(new MailToUserAfterUserCreation($mailData));
                }catch (Throwable $e) {
                    return redirect()->back()->with('warning', 'User Created But Mail Sending Issue');
                }
                return redirect('admin/system-user-list')->with('success', 'User List Added Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
        return view('admin.roles-privileges.add-system-user');
    }

    public function system_user_data_table(Request $request){
        $system_user = Admins::where('arm_master_admins.status', '!=', 'delete')->where('arm_master_admins.id', '!=', Auth::guard('arm_admins')->user()->id)->where('arm_role_privileges.status', '!=', 'delete')->join('arm_role_privileges', 'arm_role_privileges.id', '=' , 'arm_master_admins.role_id')->orderBy('id','DESC')->select('arm_master_admins.id', 'arm_master_admins.user_name', 'arm_master_admins.email', 'arm_master_admins.mobile_no', 'arm_master_admins.role_id', 'arm_master_admins.status', 'arm_role_privileges.role_name')->orderBy('arm_master_admins.id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($system_user)

                ->addIndexColumn()

                ->addColumn('user_name', function ($row) {
                    return !empty($row->user_name) ? $row->user_name : '' ;
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '' ;
                })
                ->addColumn('role', function ($row) {
                    // $role_id = Auth::guard('arm_admins')->user()->role_id;
                    // $RolesPrivileges = Arm_role_privilege::where('id', $row->role_id)->select('role_name')->get();
                    return !empty($row->email) ? $row->role_name : '' ;
                })
                ->addColumn('mobile_no', function ($row) {
                    return !empty($row->mobile_no) ? $row->mobile_no : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_edit')) {
                        $actionBtn .= '<a href="' . url('admin/system-user/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }

                    if (str_contains($RolesPrivileges, 'user_delete')) {
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="arm_master_admins" data-flash="User Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;

                    $RolesPrivileges = Arm_role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_status_change')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_master_admins" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_master_admins" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    } else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" disabled  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
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

    public function edit($id){
        try {
            $all_roles = Arm_role_privilege::where('status', 'active')->orderBy('id', 'DESC')->get();
            $system_user_details = Admins::find(Crypt::decrypt($id));
            return view('admin.roles-privileges.add-system-user', compact('all_roles', 'system_user_details'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/roles-privileges')->with('error', 'Access Denied !');
        }
    }

    public function check_user_exist(Request $request){
        if(!empty($request->user_id)){
            if(Admins::where('id', '!=', $request->user_id)->where('status', '!=', 'delete')->where('email', $request->email)->exists()){
                return "true";
            } else {
                return "false";
            }
        } else {
            if(Admins::where('status', '!=', 'delete')->where('email', $request->email)->exists()){
                return "true";
            } else {
                return "false";
            }
        } 
    }
}
