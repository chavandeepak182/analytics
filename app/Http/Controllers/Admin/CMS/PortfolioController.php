<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;

class PortfolioController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $portfolio = Portfolio::where('status', '=', 'active')->first();
        return view('admin.cms.portfolio', compact('portfolio'));
    }
    public function portfolio_view()
    {
        $portfolio = Portfolio::where('status', '=', 'active')->first();
        $portfolio_cards = PortfolioCard::where('status', '=', 'active')
            ->orderBy('sequence_no','ASC')
            ->select('*')
            ->get();
        return view('front/portfolio', compact('portfolio', 'portfolio_cards'));
    }

    public function portfolio_content($slug_uri)
    {
        // $id = Crypt::decrypt($request->id);
        $slug_url = $slug_uri;
        // dd($id);
        $portfolio = Portfolio::where('status', '=', 'active')->first();
        $portfolio_cards = PortfolioCard::where('status', '=', 'active')
            ->where('slug_url', '=', $slug_url)
            ->first();
            if(empty($portfolio_cards)){
                return redirect('404');
            }
        return view('front/portfolio-view', compact('portfolio', 'portfolio_cards'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $id = $request->txtpkey;
        if ($request->has('submit_portfolio_banner')) {
            $request->validate([
                'portfolio_heading' => 'required',
                'portfolio_description' => 'required',
            ], [
                'portfolio_heading' => 'Heading is Required',
                'portfolio_description' => 'Description is Required',
            ]);
            if ($request->has('portfolio_banner_image_path')) {
                $request->validate([
                    'portfolio_banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'portfolio_banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'portfolio_banner_image_path.required' => 'Image is Required',
                ]);
                $input['portfolio_banner_image_path'] = $this->verifyAndUpload($request, 'portfolio_banner_image_path', 'images/portfolio');
                $original_name = $request->file('portfolio_banner_image_path')->getClientOriginalName();
                $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['portfolio_heading'] = $request->portfolio_heading;
            $input['portfolio_description'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Portfolio::where('id', '=', $id)->update($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Portfolio::create($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio page added successfully!');
            }
        }
        if ($request->has('submit_portfolio_small')) {
            $request->validate([
                'portfolio_small_heading' => 'required',
            ], [
                'portfolio_small_heading' => 'Heading is Required',
            ]);
            if ($request->has('portfolio_small_image_path')) {
                $request->validate([
                    'portfolio_small_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'portfolio_small_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'portfolio_small_image_path.required' => 'Image is Required',
                ]);
                $input['portfolio_small_image_path'] = $this->verifyAndUpload($request, 'portfolio_small_image_path', 'images/portfolio');
                $original_name = $request->file('portfolio_small_image_path')->getClientOriginalName();
                $input['portfolio_small_image_name'] = $original_name;
            }
            $input['portfolio_small_heading'] = $request->portfolio_small_heading;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Portfolio::where('id', '=', $id)->update($input);
                return redirect('/admin/portfolio')->with('success', 'portfolio page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Portfolio::create($input);
                return redirect('/admin/portfolio')->with('success', 'portfolio page added successfully!');
            }
        }

        if ($request->has('submit_portfolio_meta')) {
            // $request->validate([
            //     'portfolio_meta_description' => 'required',
            //     'portfolio_meta_keyword' => 'required',
            //     'portfolio_meta_title' => 'required',
            // ], [
            //     'portfolio_meta_description' => 'Meta Description is Required',
            //     'portfolio_meta_keyword' => 'Meta Keyword is Required',
            //     'portfolio_meta_title' => 'Meta Title is Required',
            // ]);

            $input['portfolio_meta_description'] = $request->portfolio_meta_description;
            $input['portfolio_meta_keyword'] = $request->portfolio_meta_keyword;
            $input['portfolio_meta_title'] = $request->portfolio_meta_title;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Portfolio::where('id', '=', $id)->update($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio Meta updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Portfolio::create($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio Meta added successfully!');
            }
        }
    }

    public function store_card(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;
        if ($request->has('submit_portfolio_card')) {
            $request->validate([
                'portfolio_card_heading' => 'required',
                'slug_url' => 'required',
                'portfolio_card_category' => 'required',
                'sequence'=> 'required',
            ], [
                'portfolio_card_heading' => 'Heading is Required',
                'slug_url' => 'slug url is Required',
                'portfolio_card_category' => 'Category is Required',
            ]);
            // if ($request->has('portfolio_card_image_path')) {
            //     $request->validate([
            //         'portfolio_card_image_path' => "mimes:jpg,png,jpeg|required",
            //     ], [
            //         'portfolio_card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
            //         'portfolio_card_image_path.required' => 'Image is Required',
            //     ]);
            //     $input['portfolio_card_image_path'] = $this->verifyAndUpload($request, 'portfolio_card_image_path', 'images/portfolio_cards');
            //     $original_name = $request->file('portfolio_card_image_path')->getClientOriginalName();
            //     $input['portfolio_card_image_name'] = $original_name;
            // }




            // if ($request->has('portfolio_card_inside_image_path1')) {
            //     // $request->validate([
            //     //     'portfolio_card_inside_image_path1' => "mimes:jpg,png,jpeg|required",
            //     // ], [
            //     //     'portfolio_card_inside_image_path1.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
            //     //     'portfolio_card_inside_image_path1.required' => 'Image is Required',
            //     // ]);
            //     $input['portfolio_card_inside_image_path1'] = $this->verifyAndUpload($request, 'portfolio_card_inside_image_path1', 'images/portfolio_cards');
            //     $original_name = $request->file('portfolio_card_inside_image_path1')->getClientOriginalName();
           
            // }
            // if ($request->has('portfolio_card_inside_image_path2')) {
            //     // $request->validate([
            //     //     'portfolio_card_inside_image_path2' => "mimes:jpg,png,jpeg|required",
            //     // ], [
            //     //     'portfolio_card_inside_image_path2.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
            //     //     'portfolio_card_inside_image_path2.required' => 'Image is Required',
            //     // ]);
            //     $input['portfolio_card_inside_image_path2'] = $this->verifyAndUpload($request, 'portfolio_card_inside_image_path2', 'images/portfolio_cards');
            //     $original_name = $request->file('portfolio_card_inside_image_path2')->getClientOriginalName();
            // }

            // if ($request->has('portfolio_card_inside_image_path3')) {
            //     // $request->validate([
            //     //     'portfolio_card_inside_image_path3' => "mimes:jpg,png,jpeg|required",
            //     // ], [
            //     //     'portfolio_card_inside_image_path3.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
            //     //     'portfolio_card_inside_image_path3.required' => 'Image is Required',
            //     // ]);
            //     $input['portfolio_card_inside_image_path3'] = $this->verifyAndUpload($request, 'portfolio_card_inside_image_path3', 'images/portfolio_cards');
            //     $original_name = $request->file('portfolio_card_inside_image_path3')->getClientOriginalName();
            // }


            $input['portfolio_card_heading'] = $request->portfolio_card_heading;
            $input['portfolio_card_description'] = $request->portfolio_card_description;
            $input['portfolio_card_category'] = $request->portfolio_card_category;
            $input['slug_url'] = $request->slug_url;
            $input['sequence_no'] = $request->sequence;

            $input['portfolio_card_image_path'] = $request->portfolio_card_image_path;
            $input['portfolio_card_inside_image_path1'] = $request->portfolio_card_inside_image_path1;
            $input['portfolio_card_inside_image_path2'] = $request->portfolio_card_inside_image_path2;
            $input['portfolio_card_inside_image_path3'] = $request->portfolio_card_inside_image_path3;
            $input['portfolio_card_image_path'] = $request->portfolio_card_image_path;
            $input['portfolio_card_inside_image_path1'] = $request->portfolio_card_inside_image_path1;
            $input['portfolio_card_inside_image_path2'] = $request->portfolio_card_inside_image_path2;
            $input['portfolio_card_inside_image_path3'] = $request->portfolio_card_inside_image_path3;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                PortfolioCard::where('id', '=', $id)->update($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                PortfolioCard::create($input);
                return redirect('/admin/portfolio')->with('success', 'Portfolio Card added successfully!');
            }
        }

    }

    public function data_table(Request $request)
    {
        $about_us = PortfolioCard::where('status', '!=', 'delete')
            ->orderBy('sequence_no', 'ASC')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($about_us)
                ->addIndexColumn()
                ->addColumn('portfolio_card_description', function ($row) {
                    
                    if (!empty($row->portfolio_card_description)) {
                        return substr(strip_tags($row->portfolio_card_description), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
                

                ->addColumn('portfolio_card_image_path', function ($row) {
                    // return !empty($row->portfolio_card_image_path) ? '<img src="' . url('/') . Storage::url($row->portfolio_card_image_path) . '" alt="' . $row->portfolio_card_image_name . '" class="table-img"style="height: 70px; width:90px">' : '';
                    return !empty($row->portfolio_card_image_path) ? '<img src="' . ($row->portfolio_card_image_path) . '" alt="' . $row->portfolio_card_image_path . '" class="table-img"style="height: 70px; width:90px">' : '';
                })

                ->addColumn('portfolio_card_heading', function ($row) {
                    if (!empty($row->portfolio_card_heading)) {
                        return ucfirst($row->portfolio_card_heading);
                    }
                })
             
                ->addColumn('portfolio_card_category', function ($row) {
                    if (!empty($row->portfolio_card_category)) {
                        return ucfirst($row->portfolio_card_category);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/portfolio-card/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="portfolio_cards" data-flash="Record Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    
                    return $actionBtn;
                })
               
                ->addColumn('sequence_no', function ($row) {
                    if (!empty($row->sequence_no)) {
                        return ucfirst($row->sequence_no);
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="portfolio_cards" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="portfolio_cards" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['portfolio_card_heading','portfolio_card_description', 'portfolio_card_image_path', 'portfolio_card_image_name', 'portfolio_card_category','sequence_no','status', 'action'])
                ->make(true);
        }
    }




    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $portfolio = Portfolio::where('status', '=', 'active')->first();
        $portfolio_card = PortfolioCard::where('id', '=', $id)
            ->select('*')
            ->first();
        return view('admin.cms.portfolio', compact('portfolio_card', 'portfolio'));
    }


    public function filter_by_category(Request $request)
    {
        // return 'asdads';
        // dd($request);
        $category = $request->filter;
        if ($category == 'all') {
            $portfolio_cards = PortfolioCard::where('status', '=', 'active')
            ->orderBy('sequence_no','ASC')
                ->get();
        } else {
            $portfolio_cards = PortfolioCard::where('status', '=', 'active')
                ->where('portfolio_card_category', '=', $category)
               ->orderBy('sequence_no','ASC')
                ->get();
        }
        // dd($portfolio_cards);
        return $portfolio_cards;
    }
    
    public function Sequence_Exists(Request $request)
    {
        if ($request->ajax()) {
            $request->sequence_id;
                  $sequence_id = PortfolioCard::where('sequence_no', '=', $request->sequence_n)->where('id',$request->sequence_id)
                ->where('status', '!=', 'delete')
                ->first();
            if(!empty($sequence_id)){
                
                return !empty($sequence_id) ? 'true' : 'false';
            
                
            }else{
               
                  $sequence = PortfolioCard::where('sequence_no', '=', $request->sequence_n)
                ->where('status', '!=', 'delete')
                ->first();
                
               return !empty($sequence) ? 'false' : 'true';

              
            }

        } else {
            return 'No direct scripts are allowed';
        }

}

}
