<?php

namespace App\Http\Controllers\Admin\CMS\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_testimonial;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;
use App\Models\Arm_role_privilege;
use Auth;
use Crypt;
use Arr;
use Storage;

class TestimonialController extends Controller
{
    use MediaTrait;

    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'testimonials_view')){
            return view('admin.cms.testimonials.testimonials');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }

    public function store(Request $request)
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        
        $id = $request->id;

        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'description' => 'required|string',
            'image_path' => 'mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image formats and size as needed
        ]);
        
        $input['name'] = $request->name;
        $input['designation'] = $request->designation;
        $input['description'] = $request->description;

        if ($request->hasFile('image_path')) {
            $input['image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/testimonial');
            $original_name = $request->file('image_path')->getClientOriginalName();
            $input['image_name'] = $original_name;
        }

        if (!empty($id)) {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_testimonial::where('id', '=', $id)->update($input);
                return redirect('admin/testimonials')->with('success', 'Updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Arm_testimonial::create($input);
                return redirect('admin/testimonials')->with('success', 'Added Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }

    public function  data_table(Request $request)
    {

        $testimonial= Arm_testimonial::where('status', '!=', 'delete')
        ->select('id','name','designation','description','image_path','image_name','status')
        ->get();

        if ($request->ajax()) {

            return DataTables::of($testimonial)
                ->addIndexColumn()

                ->addColumn('name', function ($row) {
                    if (!empty($row->name)) {
                        return ucfirst($row->name);
                    }
                })

                ->addColumn('designation', function ($row) {
                    if (!empty($row->designation)) {
                        return ucfirst($row->designation);
                    }
                })

                ->addColumn('description', function ($row) {
                    if (!empty($row->description)) {
                        return substr(strip_tags($row->description), 0, 100) . '...';
                    }
                })

                ->addColumn('image_path', function ($row) {
                    return !empty($row->image_path) ? '<img src="' . url('/') . Storage::url($row->image_path) . '" alt="' . $row->image_name . '" class="table-img">' : '';
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_testimonial" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_testimonial" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_edit')){
                        $actionBtn .= '<a href="' . url('admin/testimonial/' .$row->id. '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_delete')){
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_testimonial" data-flash="Banner Image Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->rawColumns(['action', 'status', 'image_path'])
                ->make(true);
        }
    }

    public function edit(Request $request){
        try {
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'testimonials_edit')){
                $id=$request->id;
                $testimonial= Arm_testimonial::where('id', '=',$id)->select('id', 'name', 'designation', 'description', 'image_path', 'image_name', 'status')->first();
                return view('admin.cms.testimonials.testimonials',compact('testimonial'));
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/testimonial')->with('error', 'Access Denied !');
        }
        
    }

}
