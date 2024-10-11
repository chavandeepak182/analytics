<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\AboutUsCard;
use App\Models\Testimonial;
use App\Models\TestimonialClient;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;

class AboutUsController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $about_us = AboutUs::where('status', '=', 'active')->first();
        $about_us_count = AboutUsCard::where('status', '!=', 'delete')
            ->count();
        return view('admin.cms.about_us',compact('about_us','about_us_count'));
    }
    public function about_us_view()
    {
        $about_us = AboutUs::where('status', '=', 'active')->first();
        $about_us_cards = AboutUsCard::where('status', '=', 'active')
            ->select('*')
            ->get();
            $testimonial = Testimonial::where('status', '=', 'active')->first();
            $testimonial_clients = TestimonialClient::where('status', '=', 'active')
                ->select('*')
                ->get();
        return view('front/about_us',compact('about_us','about_us_cards','testimonial','testimonial_clients'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $id = $request->txtpkey;
        if ($request->has('submit_about_us_banner')) {
            $request->validate([
                'about_us_heading' => 'required',
                'about_us_description' => 'required',
            ], [
                'about_us_heading' => 'Heading is Required',
                'about_us_description' => 'Description is Required',
            ]);
            if ($request->has('about_us_banner_image_path')) {
                $request->validate([
                    'about_us_banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_banner_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_banner_image_path'] = $this->verifyAndUpload($request, 'about_us_banner_image_path', 'images/about_us');
                $original_name = $request->file('about_us_banner_image_path')->getClientOriginalName();
                $input['about_us_banner_image_name'] = $original_name;
            }
            $input['about_us_heading'] = $request->about_us_heading;
            $input['about_us_description'] = $request->about_us_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUs::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUs::create($input);
                return redirect('/admin/about')->with('success', 'About us page added successfully!');
            }
        }
        if ($request->has('submit_about_us_history')) {
            $request->validate([
                'about_us_history_heading' => 'required',
                'about_us_history_description' => 'required',
            ], [
                'about_us_history_heading' => 'Heading is Required',
                'about_us_history_description' => 'Description is Required',
            ]);
            if ($request->has('about_us_history_1_image_path')) {
                $request->validate([
                    'about_us_history_1_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_history_1_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_history_1_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_history_1_image_path'] = $this->verifyAndUpload($request, 'about_us_history_1_image_path', 'images/about_us');
                $original_name = $request->file('about_us_history_1_image_path')->getClientOriginalName();
                $input['about_us_history_1_image_name'] = $original_name;
            }
            if ($request->has('about_us_history_2_image_path')) {
                $request->validate([
                    'about_us_history_2_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_history_2_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_history_2_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_history_2_image_path'] = $this->verifyAndUpload($request, 'about_us_history_2_image_path', 'images/about_us');
                $original_name = $request->file('about_us_history_2_image_path')->getClientOriginalName();
                $input['about_us_history_2_image_name'] = $original_name;
            }
            if ($request->has('about_us_history_3_image_path')) {
                $request->validate([
                    'about_us_history_3_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_history_3_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_history_3_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_history_3_image_path'] = $this->verifyAndUpload($request, 'about_us_history_3_image_path', 'images/about_us');
                $original_name = $request->file('about_us_history_3_image_path')->getClientOriginalName();
                $input['about_us_history_3_image_name'] = $original_name;
            }
            $input['about_us_history_heading'] = $request->about_us_history_heading;
            $input['about_us_history_description'] = $request->about_us_history_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUs::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUs::create($input);
                return redirect('/admin/about')->with('success', 'About us page added successfully!');
            }
        }
        if ($request->has('submit_about_us_testimonial')) {
            $request->validate([
                'about_us_testimonial_heading' => 'required',
                'about_us_testimonial_description' => 'required',
            ], [
                'about_us_testimonial_heading' => 'Heading is Required',
                'about_us_testimonial_description' => 'Description is Required',
            ]);
            
            $input['about_us_testimonial_heading'] = $request->about_us_testimonial_heading;
            $input['about_us_testimonial_description'] = $request->about_us_testimonial_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUs::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUs::create($input);
                return redirect('/admin/about')->with('success', 'About us page added successfully!');
            }
        }
        if ($request->has('submit_about_us_small')) {
            $request->validate([
                'about_us_small_heading' => 'required',
            ], [
                'about_us_small_heading' => 'Heading is Required',
            ]);
            if ($request->has('about_us_small_image_path')) {
                $request->validate([
                    'about_us_small_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_small_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_small_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_small_image_path'] = $this->verifyAndUpload($request, 'about_us_small_image_path', 'images/about_us');
                $original_name = $request->file('about_us_small_image_path')->getClientOriginalName();
                $input['about_us_small_image_name'] = $original_name;
            }
            $input['about_us_small_heading'] = $request->about_us_small_heading;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUs::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUs::create($input);
                return redirect('/admin/about')->with('success', 'About us page added successfully!');
            }
        }

        if ($request->has('submit_about_us_meta')) {
            // $request->validate([
            //     'about_us_meta_description' => 'required',
            //     'about_us_meta_keyword' => 'required',
            //     'about_us_meta_title' => 'required',
            // ], [
            //     'about_us_meta_description' => 'Meta Description is Required',
            //     'about_us_meta_keyword' => 'Meta Keyword is Required',
            //     'about_us_meta_title' => 'Meta Title is Required',
            // ]);
           
            $input['about_us_meta_description'] = $request->about_us_meta_description;
            $input['about_us_meta_keyword'] = $request->about_us_meta_keyword;
            $input['about_us_meta_title'] = $request->about_us_meta_title;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUs::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us Meta updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUs::create($input);
                return redirect('/admin/about')->with('success', 'About us Meta added successfully!');
            }
        }
    }

    public function store_card(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('submit_about_us_card')) {
            $request->validate([
                'about_us_card_heading' => 'required',
                'about_us_card_description' => 'required',
            ], [
                'about_us_card_heading' => 'Heading is Required',
                'about_us_card_description' => 'Description is Required',
            ]);
            if ($request->has('about_us_card_image_path')) {
                $request->validate([
                    'about_us_card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_us_card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_us_card_image_path.required' => 'Image is Required',
                ]);
                $input['about_us_card_image_path'] = $this->verifyAndUpload($request, 'about_us_card_image_path', 'images/about_us_cards');
                $original_name = $request->file('about_us_card_image_path')->getClientOriginalName();
                $input['about_us_card_image_name'] = $original_name;
            }
            $input['about_us_card_heading'] = $request->about_us_card_heading;
            $input['about_us_card_description'] = $request->about_us_card_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUsCard::where('id', '=', $id)->update($input);
                return redirect('/admin/about')->with('success', 'About us Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUsCard::create($input);
                return redirect('/admin/about')->with('success', 'About us Card added successfully!');
            }
        }
        
    }

    public function data_table(Request $request)
    {
        $about_us = AboutUsCard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($about_us)
                ->addIndexColumn()
                ->addColumn('about_us_card_description', function ($row) {
                    if (!empty($row->about_us_card_description)) {
                        return substr(strip_tags($row->about_us_card_description), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
               
                ->addColumn('about_us_card_image_path', function ($row) {
                    return !empty($row->about_us_card_image_path) ? '<img src="' . url('/') . Storage::url($row->about_us_card_image_path) . '" alt="' . $row->about_us_card_image_name . '" class="table-img"" style="height: 70px; width:90px">' : '';
                })
                
                ->addColumn('about_us_card_heading', function ($row) {
                    if (!empty($row->about_us_card_heading)) {
                        return ucfirst($row->about_us_card_heading);
                    }
                })
                
                ->addColumn('about_us_card_category', function ($row) {
                    if (!empty($row->about_us_card_category)) {
                        return ucfirst($row->about_us_card_category);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/about-us-card/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="about_us_cards" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="about_us_cards" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="about_us_cards" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['about_us_card_heading','about_us_card_description','about_us_card_image_path','about_us_card_image_name','about_us_card_category', 'status', 'action'])
                ->make(true);
        }
    }




    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $about_us = AboutUs::where('status', '=', 'active')->first();
        $about_us_card = AboutUsCard::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.about_us', compact('about_us_card','about_us'));
    }


}
