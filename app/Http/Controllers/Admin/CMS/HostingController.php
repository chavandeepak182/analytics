<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\hosting;
use App\Models\HostingCard;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class HostingController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $hosting = hosting::where('status', '=', 'active')->first();
        return view('admin.cms.hosting',compact('hosting'));
    }
    public function hosting_view()
    {
        $hosting = hosting::where('status', '=', 'active')->first();
        $hosting_cards = HostingCard::where('status', '=', 'active')
            ->select('*')
            ->get();
        return view('front/hosting',compact('hosting','hosting_cards'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $id = $request->txtpkey;
        if ($request->has('submit_hosting_banner')) {
            $request->validate([
                'hosting_heading' => 'required',
                'hosting_description' => 'required',
            ], [
                'hosting_heading' => 'Heading is Required',
                'hosting_description' => 'Description is Required',
            ]);
            if ($request->has('hosting_banner_image_path')) {
                $request->validate([
                    'hosting_banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'hosting_banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'hosting_banner_image_path.required' => 'Image is Required',
                ]);
                $input['hosting_banner_image_path'] = $this->verifyAndUpload($request, 'hosting_banner_image_path', 'images/hosting');
                $original_name = $request->file('hosting_banner_image_path')->getClientOriginalName();
                $input['hosting_banner_image_name'] = $original_name;
            }
            $input['hosting_heading'] = $request->hosting_heading;
            $input['hosting_description'] = $request->hosting_description;
            $input['hosting_main_description'] = $request->hosting_main_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                hosting::where('id', '=', $id)->update($input);
                return redirect('/admin/hosting')->with('success', 'Hosting page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                hosting::create($input);
                return redirect('/admin/hosting')->with('success', 'Hosting page added successfully!');
            }
        }
        if ($request->has('submit_hosting_small')) {
            $request->validate([
                'hosting_small_heading' => 'required',
            ], [
                'hosting_small_heading' => 'Heading is Required',
            ]);
            if ($request->has('hosting_small_image_path')) {
                $request->validate([
                    'hosting_small_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'hosting_small_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'hosting_small_image_path.required' => 'Image is Required',
                ]);
                $input['hosting_small_image_path'] = $this->verifyAndUpload($request, 'hosting_small_image_path', 'images/hosting');
                $original_name = $request->file('hosting_small_image_path')->getClientOriginalName();
                $input['hosting_small_image_name'] = $original_name;
            }
            $input['hosting_small_heading'] = $request->hosting_small_heading;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                hosting::where('id', '=', $id)->update($input);
                return redirect('/admin/hosting')->with('success', 'Hosting page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                hosting::create($input);
                return redirect('/admin/hosting')->with('success', 'Hosting page added successfully!');
            }
        }

        if ($request->has('submit_hosting_meta')) {
            // $request->validate([
            //     'hosting_meta_description' => 'required',
            //     'hosting_meta_keyword' => 'required',
            //     'hosting_meta_title' => 'required',
            // ], [
            //     'hosting_meta_description' => 'Meta Description is Required',
            //     'hosting_meta_keyword' => 'Meta Keyword is Required',
            //     'hosting_meta_title' => 'Meta Title is Required',
            // ]);
           
            $input['hosting_meta_description'] = $request->hosting_meta_description;
            $input['hosting_meta_keyword'] = $request->hosting_meta_keyword;
            $input['hosting_meta_title'] = $request->hosting_meta_title;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                hosting::where('id', '=', $id)->update($input);
                return redirect('/admin/hosting')->with('success', 'Hosting Meta updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                hosting::create($input);
                return redirect('/admin/hosting')->with('success', 'Hosting Meta added successfully!');
            }
        }
    }

    public function store_card(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('submit_hosting_card')) {
            $request->validate([
                'hosting_card_heading' => 'required',
                'hosting_card_description' => 'required',
                // 'hosting_card_url' => 'required',
            ], [
                'hosting_card_heading' => 'Heading is Required',
                'hosting_card_description' => 'Description is Required',
                // 'hosting_card_url' => 'Url is Required',
            ]);
            if ($request->has('hosting_card_image_path')) {
                $request->validate([
                    'hosting_card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'hosting_card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'hosting_card_image_path.required' => 'Image is Required',
                ]);
                $input['hosting_card_image_path'] = $this->verifyAndUpload($request, 'hosting_card_image_path', 'images/hosting_cards');
                $original_name = $request->file('hosting_card_image_path')->getClientOriginalName();
                $input['hosting_card_image_name'] = $original_name;
            }
            $input['hosting_card_heading'] = $request->hosting_card_heading;
            $input['hosting_card_description'] = $request->hosting_card_description;
            $input['hosting_card_url'] = $request->hosting_card_url;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                HostingCard::where('id', '=', $id)->update($input);
                return redirect('/admin/hosting')->with('success', 'Hosting Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                HostingCard::create($input);
                return redirect('/admin/hosting')->with('success', 'Hosting Card added successfully!');
            }
        }
        
    }

    public function data_table(Request $request)
    {
        $about_us = HostingCard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($about_us)
                ->addIndexColumn()
                ->addColumn('hosting_card_description', function ($row) {
                    if (!empty($row->hosting_card_description)) {
                        return substr(strip_tags($row->hosting_card_description), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
               
                ->addColumn('hosting_card_image_path', function ($row) {
                    return !empty($row->hosting_card_image_path) ? '<img src="' . url('/') . Storage::url($row->hosting_card_image_path) . '" alt="' . $row->hosting_card_image_name . '" class="table-img"" style="height: 70px; width:90px">': '';
                })
                
                ->addColumn('hosting_card_heading', function ($row) {
                    if (!empty($row->hosting_card_heading)) {
                        return ucfirst($row->hosting_card_heading);
                    }
                })
                
                ->addColumn('hosting_card_url', function ($row) {
                    if (!empty($row->hosting_card_url)) {
                        return ucfirst($row->hosting_card_url);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/hosting-card/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="hosting_cards" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="hosting_cards" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="hosting_cards" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['hosting_card_heading','hosting_card_description','hosting_card_image_path','hosting_card_image_name','hosting_card_url', 'status', 'action'])
                ->make(true);
        }
    }




    public function edit($id)
    {
        //
        $id = Crypt::decrypt($id);
        $hosting = hosting::where('status', '=', 'active')->first();
        $hosting_card = HostingCard::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.hosting', compact('hosting_card','hosting'));
    }


}
