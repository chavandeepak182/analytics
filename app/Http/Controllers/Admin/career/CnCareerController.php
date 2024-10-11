<?php

namespace App\Http\Controllers\Admin\career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career_cms;
use App\Models\Career_list;
use App\Traits\MediaTrait;
use DataTables;
use Storage;

class CnCareerController extends Controller
{
    use MediaTrait;
    
    public function index(){
        $career_cms = Career_cms::where('status', '!=', 'delete')->first();
        return view('admin.career.career_details', compact('career_cms'));
    }

    public function career_cms_store(Request $request){
        if(empty($request->career_cms_id)){
            $input['created_by'] = '1';
            $input['created_ip_address'] = $request->ip();
            $created_career_cms = Career_cms::create($input);
            $request->career_cms_id = $created_career_cms->id;
        }

        if($request->has('career_section')){
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ]);
            if ($request->has('banner_image')){
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image', 'career/career_cms');
                $original_name = $request->file('banner_image')->getClientOriginalName();
                $input['banner_image_name'] = $original_name;
            }
            $message = 'Career Section Updated Successfully';
        }

        if($request->has('hr_details')){
            $request->validate([
                // 'hr_contact' => 'required|digits:10',
                'hr_email' => 'required|email',
            ]);
            $message = 'HR Details Updated Successfully';
        }

        if($request->has('career_small_banner')){
            $request->validate([
                'small_banner_heading' => 'required',
            ]);
            if ($request->has('small_banner_image')){
                $input['small_banner_image_path'] = $this->verifyAndUpload($request, 'small_banner_image', 'career/career_cms');
                $original_name = $request->file('small_banner_image')->getClientOriginalName();
                $input['small_banner_image_name'] = $original_name;
            }
            $message = 'Small Banner Updated Successfully';
        }

        if($request->has('meta_details')){
            // $request->validate([
            //     'meta_title' => 'required',
            //     'meta_keyword' => 'required',
            //     'meta_description' => 'required',
            // ]);
            $message = 'Meta Details Updated Successfully';
        }

        $inserdata = $request->all();
        $id = $request->career_cms_id;
        unset($inserdata['career_section']);
        unset($inserdata['hr_details']);
        unset($inserdata['career_small_banner']);
        unset($inserdata['meta_details']);
        unset($inserdata['career_cms_id']);
        unset($inserdata['_token']);
        unset($inserdata['banner_image']);
        unset($inserdata['small_banner_image']);
        if(!empty($input['banner_image_path'])){
            $inserdata['banner_image_path'] = $input['banner_image_path'];
            $inserdata['banner_image_name'] = $input['banner_image_name'] ;
        }
        if(!empty($input['small_banner_image_path'])){
            $inserdata['small_banner_image_path'] = $input['small_banner_image_path'];
            $inserdata['small_banner_image_name'] = $input['small_banner_image_name'] ;
        }
        $inserdata['modified_by'] = '1';
        $inserdata['modified_ip_address'] = $request->ip();
        Career_cms::where('id', $id)->update($inserdata);
        return redirect()->back()->with('success', $message);

    }

    public function career_list_store(Request $request){
        $request->validate([
            'designation' => 'required|string|max:225',
            'experience' => 'required|string|max:225',
            'career_list_description' => 'required',
            'slug_url' => 'required',
        ]);
        if ($request->has('image')){
            $input['image_path'] = $this->verifyAndUpload($request, 'image', 'career/career_cms');
            $original_name = $request->file('image')->getClientOriginalName();
            $input['image_name'] = $original_name;
        }
        $input['designation'] = $request->designation;
        $input['experience'] = $request->experience;
        $input['description'] = $request->career_list_description;
        $input['slug_url'] = $request->slug_url;

        if($request->has('career_list_id') && !empty($request->career_list_id)){
            $input['modified_by'] = '1';
            $input['modified_ip_address'] = $request->ip();
            Career_list::where('id', $request->career_list_id)->update($input);
            return redirect('/admin/career-details')->with('success', 'Career List Updated Successfully');
        } else {
            $input['created_by'] = '1';
            $input['created_ip_address'] = $request->ip();
            Career_list::create($input);
            return redirect('/admin/career-details')->with('success', 'Career List Created Successfully');
        }
    }

    public function career_list_data_table(Request $request)
    {
        $career_list = Career_list::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id','designation','experience','description','image_path','image_name','status')->get();

        if ($request->ajax()) {
            return DataTables::of($career_list)
            ->addIndexColumn()
            ->addColumn('designation', function ($row) {
                if (!empty($row->designation)) {
                    return ucfirst($row->designation);
                } 
            })
            ->addColumn('experience', function ($row) {
                if (!empty($row->experience)) {
                    return $row->experience;
                } 
            })
            ->addColumn('description', function ($row) {
                if (!empty($row->description)) {
                    return strip_tags($row->description);
                } 
            })
            ->addColumn('image', function ($row) {
                if (!empty($row->image_path) && Storage::exists($row->image_path)) {
                    return '<img src="'.  url('/').Storage::url($row->image_path) .'" width="100" height="100">';
                } else {
                    return '<img src="'. asset('admin_panel/commonarea/dist/img/default.png')  .'" width="100" height="100">';
                }
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'active') {
                    $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="career_lists" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                    return $statusActiveBtn;
                } else {
                    $statusBlockBtn =  '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="career_lists" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                    return $statusBlockBtn;
                }
            })
            ->addColumn('action', function ($row) 
            {
                $actionBtn =   '<a href="'.url('admin/career-list-edit/'.$row->id).'"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="career_lists" data-flash="Career Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['image', 'action', 'status'])
            ->make(true);
        }
    }

    public function career_list_edit(Request $request){
        $career_list = Career_list::where('status', '!=', 'delete')->where('id', $request->id)->first();
        $career_cms = Career_cms::where('status', '!=', 'delete')->first();
        if(!empty($career_list)){
            return view('admin.career.career_details', compact('career_list','career_cms'));
        }
        abort(404, 'Not found');
    }
}
