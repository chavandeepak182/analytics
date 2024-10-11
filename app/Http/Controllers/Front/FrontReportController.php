<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Models\Arm_reports;
use App\Models\Arm_research_methodology;
use App\Models\Arm_research_methodology_banner;
use App\Models\Arm_relate_report;
use Illuminate\Support\Facades\DB;

class FrontReportController extends Controller
{
    public function index(Request $request){
        if(!empty($request->page_range) && !in_array($request->page_range,config('constant.page_range'))){
            return redirect('research-reports/all?page_range='.config('constant.recordPerPage'));
        }
        $report_per_page = $request->page_range ? $request->page_range : config('constant.recordPerPage');
        $all_reports = Arm_reports::where('arm_reports.status', '=', 'active')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->select('arm_reports.*')->orderBy('arm_reports.id', 'DESC')->paginate($report_per_page);
        $report_count = Arm_reports::where('status', '=', 'active')->count();
        $report_categories = ReportCategory::where('status','=','active')->get();
        return view('front.reports', compact('all_reports', 'report_categories','report_per_page','report_count'));
    }

    public function category_wise_report($category_slug, $category_id, Request $request){
        if(!empty($request->page_range) && !in_array($request->page_range,config('constant.page_range'))){
            return redirect('research-reports/'.$category_slug.'/'.$category_id.'?page_range='.config('constant.recordPerPage'));
        }
        $report_per_page = $request->page_range ? $request->page_range : config('constant.recordPerPage');
        $all_reports = Arm_reports::where('status','=','active')->whereRaw("find_in_set('".$category_id."', category_id)")->orderBy('id', 'DESC')->paginate($report_per_page);
        $report_count = Arm_reports::where('status', '=', 'active')->whereRaw("find_in_set('".$category_id."', category_id)")->count();
        $report_categories = ReportCategory::where('status','=','active')->get();
        $category_details = ReportCategory::where('status','=','active')->where('id',$category_id)->first();
        if(empty($category_details)){
            return redirect('/404');
        }
        return view('front.reports', compact('all_reports','category_details','report_categories','report_per_page','report_count'));
    }

    public function report_details($report_slug, $report_id){
        $research = Arm_research_methodology::where('status', '=', 'active')->first();
        $banner = Arm_research_methodology_banner::where('status', '=', 'active')->get();
        $report_details = Arm_reports::where('status','=','active')->where('id',$report_id)->first();
        if(empty($report_details)){
            return redirect('/404');
        }
        $category_details = ReportCategory::where('status', 'active')->where('id',$report_details->category_id)->first();
        if(empty($category_details)){
            return redirect('/404');
        }
        // $related_reports = Arm_reports::where('status', 'active')->whereRaw("find_in_set('".explode(",",$report_details->category_id)[0]."', category_id)")->where('id','!=',$report_details->id)->orderBy('id', 'desc')->take(5)->get();
        $related_reports = Arm_relate_report::where('status', 'active')->where('report_id', $report_details->id)->with('reports')->orderBy('id', 'desc')->get();
        return view('front.reports-view', compact('report_details', 'category_details', 'related_reports', 'research', 'banner'));
    }

    public function globalSearch(Request $request){
        $filter_text = "";
        if($request->has("filter") && !empty($request->filter)){
            $filter_text = $request->filter;
        }
        if(!empty($request->page_range) && !in_array($request->page_range,config('constant.page_range'))){
            return redirect('research-reports/all?page_range='.config('constant.recordPerPage'));
        }
        $report_per_page = $request->page_range ? $request->page_range : config('constant.recordPerPage');
        $all_reports = Arm_reports::where('arm_reports.status', '=', 'active')->where('arm_reports.title', 'LIKE', '%'.$filter_text.'%')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->select('arm_reports.*')->orderBy('arm_reports.id', 'DESC')->take($report_per_page)->get();
        $report_count = Arm_reports::where('status', '=', 'active')->count();
        $report_categories = ReportCategory::where('status','=','active')->with('reports')->get();
        return view('front.reports', compact('all_reports', 'report_categories','report_count','filter_text'));
    }

}
