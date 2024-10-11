<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Models\Arm_role_privilege;
use App\Library\UserLogActivity;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;
use Auth;
use Crypt;
use Arr;
use Storage;


class CategoryController extends Controller
{
    use MediaTrait;
    
    public function index()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'master_view') && str_contains($RolesPrivileges, 'category_view')){
            return view('admin.master.category.category');
        }else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function category_data_table(Request $request)
    {
        $category = ReportCategory::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id', 'category_name', 'status', 'image_path', 'image_name')->get();

        if ($request->ajax()) {
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('category_name', function($row){
                    return!empty($row->category_name) ? ucfirst($row->category_name) : '';
                })

                ->addColumn('image', function($row){
                    return !empty($row->image_path) && Storage::exists($row->image_path) ? '<img src="'.url('/').Storage::url($row->image_path).'"  alt="'.$row->image_name.'" class="table-img">' : '';
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_report_categories" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_report_categories" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    }else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    }
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_edit')){
                        $actionBtn .= '<a href="' . url('admin/category/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    }else{
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_delete')){
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_report_categories" data-flash="Category Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    }else{
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                
                ->rawColumns(['action', 'status','image'])
                ->make(true);
        }
    }

    // Add or Update state
    public function store(Request $request)
    {
        $id = $request->id;

        if($request->has('category_details')){
            $request->validate([
                'category_name' => 'required|min:3|max:255',
                'image_path' => 'image|mimes:jpeg,png,jpg',
                'heading' => 'max:50',
                // 'description' => 'max:750',
            ]);
        }
        $input['category_name'] = $request->category_name;
        $input['heading'] = $request->heading;
        $input['description'] = $request->description;
        $input['meta_title'] = $request->meta_title;
        $input['meta_keyword'] = $request->meta_keyword;
        $input['meta_description'] = $request->meta_description;

        if ($request->has('image_path')){
            $input['image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/category');
            $original_name = $request->file('image_path')->getClientOriginalName();
            $input['image_name'] = $original_name;
        }

        if(!empty($id)){
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_edit') && str_contains($RolesPrivileges, 'category_view')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                ReportCategory::where('id', '=', $id)->update($input);
                return redirect('/admin/category')->with('success', 'Category Updated successfully!');
            }else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
            
        }
        else{
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_add') && str_contains($RolesPrivileges, 'category_view')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                ReportCategory::create($input);
                return redirect('/admin/category')->with('success', 'Category added successfully!');
            }else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
            
        }
        
    }

    // Edit Category
    public function edit($id){
        try {
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_edit') && str_contains($RolesPrivileges, 'category_view')){
                $reportCategory = ReportCategory::find(Crypt::decrypt($id));
                return view('admin/master/category/category', compact('reportCategory'));
            }else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('/admin/category')->with('error', 'Access Denied !');
        }
    }

}
