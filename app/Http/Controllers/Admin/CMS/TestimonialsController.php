<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialClient;
use App\Models\TestimonialLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;

class TestimonialsController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $testimonial = Testimonial::where('status', '=', 'active')->first();
        return view('admin.cms.testimonial',compact('testimonial'));
    }
   
    public function store(Request $request)
    {
        $id = $request->txtpkey;
       
        if ($request->has('submit_testimonial_meta')) {
            // $request->validate([
            //     'testimonial_meta_description' => 'required',
            //     'testimonial_meta_keyword' => 'required',
            //     'testimonial_meta_title' => 'required',
            // ], [
            //     'testimonial_meta_description' => 'Meta Description is Required',
            //     'testimonial_meta_keyword' => 'Meta Keyword is Required',
            //     'testimonial_meta_title' => 'Meta Title is Required',
            // ]);
           
            $input['testimonial_meta_description'] = $request->testimonial_meta_description;
            $input['testimonial_meta_keyword'] = $request->testimonial_meta_keyword;
            $input['testimonial_meta_title'] = $request->testimonial_meta_title;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Testimonial::where('id', '=', $id)->update($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Meta updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Testimonial::create($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Meta added successfully!');
            }
        }
    }


    public function store_logo(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('logo_submit')) {

            if ($request->has('testimonial_logo_image_path')) {
                $request->validate([
                    'testimonial_logo_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'testimonial_logo_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'testimonial_logo_image_path.required' => 'Image is Required',
                ]);
                $input['testimonial_logo_image_path'] = $this->verifyAndUpload($request, 'testimonial_logo_image_path', 'images/testimonial_logo');
                $original_name = $request->file('testimonial_logo_image_path')->getClientOriginalName();
                $input['testimonial_logo_image_name'] = $original_name;
            }

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                TestimonialLogo::where('id', '=', $id)->update($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                TestimonialLogo::create($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Card added successfully!');
            }
        }

    }

    public function logo_data_table(Request $request)
    {
        $logo = TestimonialLogo::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($logo)
                ->addIndexColumn()

                ->addColumn('testimonial_logo_image_path', function ($row) {
                    return !empty($row->testimonial_logo_image_path) ? '<img src="' . url('/') . Storage::url($row->testimonial_logo_image_path) . '" alt="' . $row->testimonial_logo_image_name . '" class="table-img"" style="height: 70px; width:90px;background-color: #dadada;">' : '';
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/testimonial-page-logo/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="testimonial_logo" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="testimonial_logo" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="testimonial_logo" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['testimonial_logo_image_path', 'status', 'action'])
                ->make(true);
        }
    }

    public function edit_logo($id)
    {
        $id = Crypt::decrypt($id);
        $testimonial = Testimonial::where('status', '=', 'active')->first();
        $testimonial_logo = TestimonialLogo::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.testimonial', compact('testimonial_logo', 'testimonial'));
    }
    public function store_client(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('submit_testimonial_client')) {
            $request->validate([
                'testimonial_client_name' => 'required',
                'testimonial_client_designation' => 'required',
                'testimonial_client_description' => 'required',
            ], [
                'testimonial_client_name' => 'Heading is Required',
                'testimonial_client_designation' => 'Designation is Required',
                'testimonial_client_description' => 'Description is Required',
            ]);
            if ($request->has('testimonial_client_image_path')) {
                $request->validate([
                    'testimonial_client_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'testimonial_client_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'testimonial_client_image_path.required' => 'Image is Required',
                ]);
                $input['testimonial_client_image_path'] = $this->verifyAndUpload($request, 'testimonial_client_image_path', 'images/testimonial_clients');
                $original_name = $request->file('testimonial_client_image_path')->getClientOriginalName();
                $input['testimonial_client_image_name'] = $original_name;
            }
            $input['testimonial_client_name'] = $request->testimonial_client_name;
            $input['testimonial_client_designation'] = $request->testimonial_client_designation;
            $input['testimonial_client_description'] = $request->testimonial_client_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                TestimonialClient::where('id', '=', $id)->update($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                TestimonialClient::create($input);
                return redirect('/admin/testimonial')->with('success', 'Testimonial Card added successfully!');
            }
        }
        
    }
    public function data_table(Request $request)
    {
      
        $testimonial = TestimonialClient::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();
         

        if ($request->ajax()) {
            return DataTables::of($testimonial)
                ->addIndexColumn()
                ->addColumn('testimonial_client_description', function ($row) {
                    if (!empty($row->testimonial_client_description)) {
                        return substr(strip_tags($row->testimonial_client_description), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
               
                ->addColumn('testimonial_client_image_path', function ($row) {
                    return !empty($row->testimonial_client_image_path) ? '<img src="' . url('/') . Storage::url($row->testimonial_client_image_path) . '" alt="' . $row->testimonial_client_image_name . '" class="table-img"style="height: 70px; width:90px">' : '';
                })
                
                ->addColumn('testimonial_client_name', function ($row) {
                    if (!empty($row->testimonial_client_name)) {
                        return ucfirst($row->testimonial_client_name);
                    }
                })
                
                ->addColumn('testimonial_client_designation', function ($row) {
                    if (!empty($row->testimonial_client_designation)) {
                        return ucfirst($row->testimonial_client_designation);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/testimonial-client/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="testimonial_client" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="testimonial_client" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="testimonial_client" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['testimonial_client_name','testimonial_client_designation','testimonial_client_image_path','testimonial_client_image_name','testimonial_client_description', 'status', 'action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $testimonial = Testimonial::where('status', '=', 'active')->first();
        $testimonial_client = TestimonialClient::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.testimonial', compact('testimonial_client','testimonial'));
    }
}
