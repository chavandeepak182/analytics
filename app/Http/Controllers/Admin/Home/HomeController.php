<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\BlogPage;
use App\Models\HomePageBanner;
use App\Models\PortfolioCard;
use App\Models\TestimonialClient;
use App\Models\TestimonialLogo;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\HomePageLogo;
use App\Models\StratergicBanner;
use App\Models\AppBanner;
use \App\Models\DigitalBanner;
use \App\Models\CustomBanner;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;

class HomeController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $home = Home::where('status', '=', 'active')->first();
        return view('admin/cms/homepage', compact('home'));
    }
    public function home_view()
    {
        $home = Home::where('status', '=', 'active')->first();
        $home_banners = HomePageBanner::where('status', '=', 'active')
            ->select('*')
            ->get();
        $home_logos = HomePageLogo::where('status', '=', 'active')
            ->select('*')
            ->get();
        $about_us = AboutUs::where('status', '=', 'active')->first();
        $portfolio_cards = PortfolioCard::where('status', '=', 'active')
            ->select('*')
            ->orderBy('sequence_no','ASC')
            ->limit(8)
            ->get();
        $testimonial_clients = TestimonialClient::where('status', '=', 'active')
            ->select('*')
            ->get();
        $blogs = Blog::where('status', '=', 'active')
            ->select('*')
            ->get();
        $testimonial_logos = TestimonialLogo::where('status', '=', 'active')
            ->select('*')
            ->get();
        $blogpage = BlogPage::first();
        $strategic_consulting = StratergicBanner::first();
        $custom_developent = CustomBanner::first();
        $App_developement = AppBanner::first();
        $digital_marketing = DigitalBanner::first();

        return view(
            'front/index',
            compact(
                'home',
                'home_banners',
                'home_logos',
                'about_us',
                'testimonial_logos',
                'blogpage',
                'portfolio_cards',
                'testimonial_clients',
                'blogs',
                'strategic_consulting',
                'custom_developent',
                'App_developement',
                'digital_marketing'
            )
        );
    }


    public function store(Request $request)
    {

        $id = $request->txtpkey;

        if ($request->has('submit_home_small')) {

            $request->validate([
                'home_small_heading' => 'required',
            ], [
                'home_small_heading' => 'Heading is Required',
            ]);
            if ($request->has('home_small_image_path')) {
                $request->validate([
                    'home_small_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'home_small_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'home_small_image_path.required' => 'Image is Required',
                ]);
                $input['home_small_image_path'] = $this->verifyAndUpload($request, 'home_small_image_path', 'images/home');
                $original_name = $request->file('home_small_image_path')->getClientOriginalName();
                $input['home_small_image_name'] = $original_name;
            }
            $input['home_small_heading'] = $request->home_small_heading;
            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Home::where('id', '=', $id)->update($input);
                return redirect('/admin/homepage')->with('success', 'Home page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('/admin/homepage')->with('success', 'Home page added successfully!');
            }
        }

        if ($request->has('submit_home_meta')) {
            // $request->validate([
            //     'home_meta_description' => 'required',
            //     'home_meta_keyword' => 'required',
            //     'home_meta_title' => 'required',
            // ], [
            //     'home_meta_description' => 'Meta Description is Required',
            //     'home_meta_keyword' => 'Meta Keyword is Required',
            //     'home_meta_title' => 'Meta Title is Required',
            // ]);

            $input['home_meta_description'] = $request->home_meta_description;
            $input['home_meta_keyword'] = $request->home_meta_keyword;
            $input['home_meta_title'] = $request->home_meta_title;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Home::where('id', '=', $id)->update($input);
                return redirect('/admin/homepage')->with('success', 'Home Meta updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('/admin/homepage')->with('success', 'Home Meta added successfully!');
            }
        }

        if ($request->has('submit_cookie_consent')){

            $request->validate([
                'cookie_heading' => 'required|max:30',
                'cookie_url_name' => 'required|max:40',
                'cookie_description' => 'required|max:150',
            ],[
                'cookie_heading.required' => 'This field is required',
                'cookie_heading.max' => 'Please enter 30 characters Only',
                'cookie_url_name.required' => 'This field is required',
                'cookie_url_name.max' => 'Please enter 40 characters Only',
                'cookie_description.required' => 'This field is required',
                'cookie_description.max' => 'Please enter 150 characters Only',
            ]);

            $input['cookie_heading'] = $request->cookie_heading;
            $input['cookie_url_name'] = $request->cookie_url_name;
            $input['cookie_description'] = $request->cookie_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Home::find($id)->update($input);
                return redirect('/admin/homepage')->with('success', 'Cookie Updated Successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('/admin/homepage')->with('success', 'Cookie Added Successfully!');
            }
        }
    }

    public function store_logo(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('logo_submit')) {

            if ($request->has('home_logo_image_path')) {
                $request->validate([
                    'home_logo_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'home_logo_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'home_logo_image_path.required' => 'Image is Required',
                ]);
                $input['home_logo_image_path'] = $this->verifyAndUpload($request, 'home_logo_image_path', 'images/home_logo');
                $original_name = $request->file('home_logo_image_path')->getClientOriginalName();
                $input['home_logo_image_name'] = $original_name;
            }

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                HomePageLogo::where('id', '=', $id)->update($input);
                return redirect('/admin/homepage')->with('success', 'Home Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                HomePageLogo::create($input);
                return redirect('/admin/homepage')->with('success', 'Home Card added successfully!');
            }
        }

    }
    public function store_banner(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if (($request->has('section_1_image_path')) && ($request->has('section_1_video_path'))) {
            return redirect('admin/homepage')->with('error', 'You can select either an Image or a Video.');
        }
        if (!empty($id) && $request->has('section_1_image_path') || $request->has('section_1_video_path')) {
            $input = [
                'section_1_image_path' => null,
                'section_1_image_name' => null,
                'section_1_video_path' => null,
                'section_1_video_name' => null,
            ];
            HomePageBanner::where('id', $id)->update($input);
        }


        if ($request->has('home_submit')) {
            $request->validate([
                'section_1_heading' => 'required',
                'section_1_description' => 'required',
            ], [
                'section_1_heading' => 'Heading is Required',
                'section_1_description' => 'Description is Required',
            ]);

            if ($request->has('section_1_image_path')) {
                $request->validate([
                    'section_1_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'section_1_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'section_1_image_path.required' => 'Image is Required',
                ]);
                $input['section_1_image_path'] = $this->verifyAndUpload($request, 'section_1_image_path', 'images/home/images');
                $original_name = $request->file('section_1_image_path')->getClientOriginalName();
                $input['section_1_image_name'] = $original_name;
            }

            if ($request->has('section_1_video_path')) {
                // $request->validate([
                //     'section_1_video_path' => "mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|required"
                // ], [
                //     'section_1_video_path.mimes' => 'Video Must Be a mpeg,ogg,MP4,webm,3gp,mov,flv,avi,wmv,ts File',
                //     'section_1_video_path.required' => 'Video is Required',
                // ]);
                $input['section_1_video_path'] = $this->verifyAndUpload($request, 'section_1_video_path', 'images/home/videos');
                $original_name = $request->file('section_1_video_path')->getClientOriginalName();
                $input['section_1_video_name'] = $original_name;
            }
            $input['section_1_heading'] = $request->section_1_heading;
            $input['section_1_description'] = $request->section_1_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                HomePageBanner::where('id', '=', $id)->update($input);
                return redirect('admin/homepage')->with('success', 'Home page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                HomePageBanner::create($input);
                return redirect('admin/homepage')->with('success', 'Home page added successfully!');
            }
        }

    }

    // public function data_table(Request $request)
    // {
    //     $banner = HomePageBanner::where('status', '!=', 'delete')
    //         ->orderBy('id', 'desc')
    //         ->select('*')
    //         ->get();

    //     if ($request->ajax()) {
    //         return DataTables::of($banner)
    //             ->addIndexColumn()
    //             ->addColumn('section_1_heading', function ($row) {
    //                 if (!empty($row->section_1_heading)) {
    //                     return substr(strip_tags($row->section_1_heading), 0, 100) . '...';
    //                 } else {
    //                     return '';
    //                 }
    //             })
    //             ->addColumn('media', function ($row) {
    //                 if (!empty($row->section_1_image_path)) {
    //                     return '<img src="' . url('/') . Storage::url($row->section_1_image_path) . '" alt="' . $row->section_1_image_name . '" class="table-img" style="height: 70px; width: 90px">';
    //                 } else {
    //                     return '<video width="150" height="100" controls autoplay><source src="' . url('/') . Storage::url($row->section_1_video_path) . '" type="video/mp4"></video>';
    //                 }
    //             })


    //             ->addColumn('section_1_description', function ($row) {
    //                 if (!empty($row->section_1_description)) {
    //                     return ucfirst($row->section_1_description);
    //                 }
    //             })


    //             ->addColumn('action', function ($row) {
    //                 $actionBtn = '<a href="' . url('admin/home-page-banner/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
    //                         <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

    //                 return $actionBtn;
    //             })
    //             ->addColumn('status', function ($row) {
    //                 if ($row->status == 'active') {
    //                     $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
    //                     return $statusActiveBtn;
    //                 } else {
    //                     $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
    //                     return $statusBlockBtn;
    //                 }
    //             })
    //             ->rawColumns(['section_1_heading', 'section_1_description', 'media', 'status', 'action'])
    //             ->make(true);
    //     }
    // }
    public function data_table(Request $request)
    {
        $banner = HomePageBanner::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        $activeCount = HomePageBanner::where('status', '=', 'active')->count();

        if ($request->ajax()) {
            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('section_1_heading', function ($row) {
                    if (!empty($row->section_1_heading)) {
                        return substr(strip_tags($row->section_1_heading), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
                ->addColumn('media', function ($row) {
                    if (!empty($row->section_1_image_path)) {
                        return '<img src="' . url('/') . Storage::url($row->section_1_image_path) . '" alt="' . $row->section_1_image_name . '" class="table-img" style="height: 70px; width: 90px">';
                    } else {
                        return '<video width="150" height="100" controls autoplay><source src="' . url('/') . Storage::url($row->section_1_video_path) . '" type="video/mp4"></video>';
                    }
                })


                ->addColumn('section_1_description', function ($row) {
                    if (!empty($row->section_1_description)) {
                        return ucfirst($row->section_1_description);
                    }
                })
                ->addColumn('action', function ($row) use ($activeCount) {
                    $actionBtn = '';
    
                    if ($activeCount > 1 && $row->status === 'active') {
                        $actionBtn .= '<a href="' . url('admin/home-page-banner/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } elseif($activeCount > 1 && $row->status === 'inactive') {
                        $actionBtn .= '<a href="' . url('admin/home-page-banner/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<button type="button" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button>';
                    }
    
                    if ($activeCount > 1 && $row->status === 'active') {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } elseif($activeCount > 1 && $row->status === 'inactive') {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<button type="button" class="btn btn-danger delete btn-xs" title="Delete" disabled><i class="fa fa-trash"></i></button>';
                    }
    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) use ($activeCount) {
                    $statusBtn = '';
    
                    if ($activeCount > 1  && $row->status == 'active') {
                        $statusBtn .= ($row->status == 'active') ?
                            '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>' :
                            '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></i></a>';
                    } elseif($row->status == 'inactive') {
                        $statusBtn .= ($row->status == 'inactive') ?
                        '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></i></a>':
                         '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_banner" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                } else {
                        $statusBtn .= ($row->status == 'active') ?
                            '<i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i>' :
                            '<i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i>';
                    }
    
                    return $statusBtn;
                })
                ->rawColumns(['section_1_heading', 'section_1_description', 'media', 'status', 'action'])
                ->make(true);
        }
    }


    public function logo_data_table(Request $request)
    {
        $logo = HomePageLogo::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($logo)
                ->addIndexColumn()

                ->addColumn('home_logo_image_path', function ($row) {
                    return !empty($row->home_logo_image_path) ? '<img src="' . url('/') . Storage::url($row->home_logo_image_path) . '" alt="' . $row->home_logo_image_name . '" class="table-img"" style="height: 70px; width:90px">' : '';
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/home-page-logo/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="home_page_logo" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_logo" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="home_page_logo" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['home_logo_image_path', 'status', 'action'])
                ->make(true);
        }
    }




    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $home = home::where('status', '=', 'active')->first();
        $home_banner = HomePageBanner::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.homepage', compact('home_banner', 'home'));
    }
    public function edit_logo($id)
    {
        $id = Crypt::decrypt($id);
        $home = home::where('status', '=', 'active')->first();
        $home_logo = HomePageLogo::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.homepage', compact('home_logo', 'home'));
    }


}
