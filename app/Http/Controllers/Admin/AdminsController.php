<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\RolesPrivileges;
use App\Models\Master\Admins;
use App\Models\Master\States;
use App\Models\Master\Cities;
use App\Library\UserLogActivity;
use Auth;
use Yajra\DataTables\DataTables;
use Crypt;
use App\Traits\MediaTrait;
use Hash;
use Arr;

class AdminsController extends Controller
{
    use MediaTrait;
    public function index()
    {
        if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'view_user') || str_contains(Auth::guard('arm_admins')->user()->privileges, 'add_user') || str_contains(Auth::guard('arm_admins')->user()->privileges, 'edit_user') || str_contains(Auth::guard('arm_admins')->user()->privileges, 'delete_user') || str_contains(Auth::guard('arm_admins')->user()->privileges, 'user_status')) {
            return view('admin/system_users/users/users');
        } else {
            return redirect()->back()->with('error', 'Your are not authorized for this page.!');
        }
    }

    // Data table for System Users data
    public function system_users_data_table(Request $request)
    {

        $users = Admins::where('Arm_master_admins.status', '!=', 'delete')
                        ->orderBy('Arm_master_admins.id', 'DESC')
                        ->join('lsm_master_cities','Arm_master_admins.city_id','lsm_master_cities.id')
                        ->select('Arm_master_admins.id', 'user_name','email','mobile_no','city_id','city_name','Arm_master_admins.status')
                        ->get();

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('user_name', function($row){
                    return !empty($row->user_name) ? ucfirst($row->user_name) : '';
                })
                ->addColumn('city_name', function($row){
                    return !empty($row->city_name) ? ucfirst($row->city_name) : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    if(str_contains(Auth::guard('arm_admins')->user()->privileges, 'view_user')){
                        $actionBtn .= '<a href="' . url('admin/users/' . Crypt::encrypt($row->id) . '/view') . '"> <button type="button" class="btn btn-primary btn-xs View_button" title="View"><i class="fa fa-eye"></i></button></a>';
                    }else{
                        $actionBtn .= '<a href="javascript:;" disabled> <button type="button" data-id="" class="btn btn-primary btn-xs View_button" title="Disabled" disabled><i class="fa fa-eye"></i></button></a>';
                    }
                    if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'edit_user')) {
                        $actionBtn .= '<a href="' . url('admin/users/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" disabled> <button type="button" data-id="" class="btn btn-warning btn-xs Edit_button" title="Disabled" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'delete_user')) {
                        $actionBtn .= '<button onClick="deleteUser(' . ($row->id) . ')"class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled"><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'user_status')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<button onClick="UserStatusChange(' . ($row->id) . ')"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></button>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<button onClick="UserStatusChange(' . ($row->id) . ')"><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    } else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;"  title="Disabled" ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;"  title="Disabled" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    }
                })
                ->rawColumns(['action', 'status','user_name','city_name'])
                ->make(true);
        }
    }

    // create user page
    public function create_user()
    {
        if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'add_user')) {
            $roles = RolesPrivileges::where('status','=','active')->select('id','role_name')->get();
            $states = States::where('status','active')->select('id','state_name')->get();
            return view('admin/system_users/users/add_users', compact('roles','states'));
        } else {
            return redirect()->back()->with('error', 'Your are not authorized for this page.!');
        }
    }

    // Add or Update roles and privileges
    public function store(Request $request)
    {
        if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'add_user') || str_contains(Auth::guard('arm_admins')->user()->privileges, 'edit_user')) {
            
            $request->validate([
                'role_id' => 'required',
                'user_name' => 'required',
                'mobile_no' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'email' => 'required',
                'password' => 'required',
                'address' => 'required',
            ]);
            $input = $request->all();
            $txtpkey = !empty($input['txtpkey']) ? Crypt::decrypt($input['txtpkey']) : '';
            $old_data = Admins::find($txtpkey);
            if (!empty($txtpkey)) {
                if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'edit_user')) {
                    $check_id = Admins::where('id', '!=', $txtpkey)
                        ->where('user_name', '=', $request->user_name)
                        ->where('status', '!=', 'delete')
                        ->first();
                    if (!empty($check_id)) {
                        return redirect('/admin/users')->with('error', 'This user already exists.');
                    } else {
                        //update user

                        if ($request->has('user_profile_image_path')) {
                            $input['user_profile_image_path'] = $this->verifyAndUpload($request, 'user_profile_image_path', 'images/User-profile-images');
                            $original_name = $request->file('user_profile_image_path')->getClientOriginalName();
                            $input['user_profile_image_name'] = $original_name;
                        }

                        $input['password'] = Hash::make($request->password);
                        $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                        $input['modified_ip_address'] = $request->ip();
                        $input = Arr::except($input, ['_token', 'txtpkey']);
                        $Md_user = Admins::where('id', $txtpkey)->update($input);

                        // Update Users
                        $privileges_of_this_user = RolesPrivileges::where('id',$request->role_id)->first();

                        if(!empty($user_for_this_role)){
                            $privilege_of_role['privileges'] = $privileges_of_this_user->privileges;
                            $privilege_of_role['modified_by'] = auth()->guard('arm_admins')->user()->id;
                            $privilege_of_role['modified_ip_address'] = $request->ip();
                            $user_privileges_update = Admins::where('id', $txtpkey)->update($privilege_of_role);
                            $new_user_privilege_data = Admins::where('id',$txtpkey)->first();
                            UserLogActivity::createLogActivity(json_encode($new_user_privilege_data), json_encode($privileges_of_this_user), 'Privilege for User', 'update');
                        }
                        $new_data = Admins::find($txtpkey);
                        UserLogActivity::createLogActivity(json_encode($new_data), json_encode($old_data), 'User', 'update');
                        return redirect('/admin/users')->with('success', 'User updated successfully!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Your are not authorized for this action.!');
                }
            } else {
                if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'add_user')) {
                    //create State
                    $check_duplicate = Admins::where('user_name', '=', $request->user_name)
                        ->where('status', '!=', 'delete')
                        ->get();
                    if (($check_duplicate)->isEmpty()) {

                        if ($request->has('user_profile_image_path')) {
                            $input['user_profile_image_path'] = $this->verifyAndUpload($request, 'user_profile_image_path', 'images/User-profile-images');
                            $original_name = $request->file('user_profile_image_path')->getClientOriginalName();
                            $input['user_profile_image_name'] = $original_name;
                        }

                        $input['password'] = Hash::make($request->password);
                        $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                        $input['created_ip_address'] = $request->ip();

                        $Md_user = Admins::create($input);

                        $privileges_of_this_user = RolesPrivileges::where('id',$request->role_id)->first();

                        if(!empty($user_for_this_role)){
                            $privilege_of_role['privileges'] = $privileges_of_this_user->privileges;
                            $privilege_of_role['modified_by'] = auth()->guard('arm_admins')->user()->id;
                            $privilege_of_role['modified_ip_address'] = $request->ip();
                            $user_privileges_update = Admins::where('id', $txtpkey)->update($privilege_of_role);
                            $new_user_privilege_data = Admins::where('id',$txtpkey)->first();
                            UserLogActivity::createLogActivity(json_encode($new_user_privilege_data), json_encode($privileges_of_this_user), 'Privilege for User', 'update');
                        }

                        UserLogActivity::createLogActivity(json_encode($Md_user), Null, 'User', 'create');
                        return redirect('/admin/users')->with('success', 'User added successfully!');
                    } else {
                        return redirect('/admin/users')->with('error', 'This user already exists!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Your are not authorized for this action.!');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Your are not authorized for this action.!');
        }
    }

    // check duplicate data for client side
    public function user_exists(Request $request)
    {
    
        if($request->ajax()){
            $user_name = Admins::where('user_name','=',$request->user_name)
                    ->where('status','!=','delete')
                    ->select('user_name');
                    if(!empty($request->txtpkey)){
                        $user_name = $user_name->where('id','!=',Crypt::decrypt($request->txtpkey));
                    }
                    $user_name = $user_name->first();

                    return !empty($role_name) ? 'false' : 'true';
        }else{
            return 'No direct scripts are allowed';
        }
    }

    // get user data for edit
    public function user_edit(string $id)
    {
        if(str_contains(Auth::guard('arm_admins')->user()->privileges,'edit_user')){
            // decrypt id and get data from all tables
            $id = Crypt::decrypt($id);
            $user = Admins::find($id,['user_name','id','role_id','mobile_no','email','state_id','city_id','address','user_profile_image_path','user_profile_image_name']);

            $states = States::where('status','active')->orWhere('id',$user->state_id)->select('id','state_name')->get();
            $cities = Citites::where('status','active')->where('state_id',$user->state_id)->orWhere('id',$user->city_id)->select('id','city_name')->get();
            $roles = Roles::where('status','active')->orWhere('id',$user->role_id)->select('id','role_name')->get();

            if(!empty($user)){
                $txtpkey = Crypt::encrypt($user['id']);
                $role['txtpkey'] = $txtpkey;
            }
            return view('admin/system_users/users/add_users', compact('user','states','cities','roles'));
        }else{
            return redirect()->back()->with('error','Your are not authorized for this action.!');
        }
    }

    // get role data for view
    public function user_view(string $id)
    {
        if(str_contains(Auth::guard('arm_admins')->user()->privileges,'view_user')){
            // decrypt id and get data from all tables
            $id = Crypt::decrypt($id);

            $user = Admins::where('Arm_master_admins.id',$id)
                            ->join('lsm_master_states','Arm_master_admins.state_id','lsm_master_states.id')
                            ->join('lsm_master_cities','Arm_master_admins.city_id','lsm_master_cities.id')
                            ->join('lsm_master_roles_privileges','Arm_master_admins.role_id','lsm_master_roles_privileges.id')
                            ->select('user_name','role_name','state_name','city_name','mobile_no','email','user_profile_image_path','user_profile_image_name','address','id')->first();
            
            if(!empty($user)){
                $txtpkey = Crypt::encrypt($user['id']);
                $role['txtpkey'] = $txtpkey;
            }
            return view('admin/system_users/users/view_users', compact('user'));
        }else{
            return redirect()->back()->with('error','Your are not authorized for this action.!');
        }
    }

    public function delete_user(Request $request)
    {
        if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'delete_user')) {
            $old_data = Admins::where('id',$request->id)->first();
            $data = Admins::where('id', ($request->id))->update([
                'status' => 'delete',
                'modified_by' => Auth::guard('arm_admins')->user()->id,
                'modified_ip_address' => $_SERVER['REMOTE_ADDR']
            ]);
            if($data){
                UserLogActivity::createLogActivity(json_encode($data), json_encode($old_data), 'User', 'delete');
                return response()->json(['message' => 'User deleted successfully.', 'status' => 'true']);
            }else{
                return response()->json(['message' => 'User not deleted.', 'status' => 'false']);
            }
        } else {
            return response()->json(['message' => 'Your are not authorized for this action.!', 'status' => 'false']);
        }
    }

    public function user_status(Request $request)
    {
        if (str_contains(Auth::guard('arm_admins')->user()->privileges, 'user_status')) {

            $status = Admins::where('id', ($request->id))->value('status');
            
            if ($status == 'active') {
                $block_status = Admins::where('id', ($request->id))->update([
                    'status' => 'inactive',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);

                if($block_status){
                    UserLogActivity::createLogActivity(json_encode($block_status), json_encode($status), 'User', 'status-change');
                    return response()->json(['message' => 'Status changed successfully.', 'status' => 'true']);
                }else{
                    return response()->json(['message' => 'Status not changed.', 'status' => 'false']);
                }
            } 
            else 
            {
                $active_status = Admins::where('id', ($request->id))->update([
                    'status' => 'active',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);

                if($active_status){
                    UserLogActivity::createLogActivity(json_encode($active_status), json_encode($status), 'User', 'status-change');
                    return response()->json(['message' => 'Status changed successfully.', 'status' => 'true']);
                }else{
                    return response()->json(['message' => 'Status not changed.', 'status' => 'false']);
                }
            }
        } else {
            return response()->json(['message' => 'Your are not authorized for this action.!', 'status' => 'false']);
        }
    }
}
