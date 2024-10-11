<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Models\Arm_reports;
use App\Models\Arm_research_methodology;
use App\Models\Arm_research_methodology_banner;
use App\Models\Arm_relate_report;

class FrontUpcomingReportController extends Controller
{
    public function index(Request $request){
        
        if(!empty($request->page_range) && !in_array($request->page_range,config('constant.page_range'))){
            return redirect('research-reports/all?page_range='.config('constant.recordPerPage'));
        }
        $report_per_page = $request->page_range ? $request->page_range : config('constant.recordPerPage');
        $all_reports = Arm_reports::where('arm_reports.status', 'active')->where('arm_reports.upcoming_report', 'yes')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->select('arm_reports.*')->orderBy('arm_reports.id', 'DESC')->paginate($report_per_page);
        $report_count = Arm_reports::where('status', 'active')->where('upcoming_report', 'yes')->count();
        $report_categories = ReportCategory::where('status', 'active')->with('reports')->get();
        return view('front.upcoming_report.upcoming_report', compact('all_reports', 'report_categories','report_per_page','report_count'));
    }

    public function category_wise_report($category_slug, $category_id, Request $request){
        if(!empty($request->page_range) && !in_array($request->page_range,config('constant.page_range'))){
            return redirect('research-reports/'.$category_slug.'/'.$category_id.'?page_range='.config('constant.recordPerPage'));
        }
        $report_per_page = $request->page_range ? $request->page_range : config('constant.recordPerPage');
        $all_reports = Arm_reports::where('status','=','active')->where('category_id',$category_id)->paginate($report_per_page);
        $report_count = Arm_reports::where('status', '=', 'active')->where('upcoming_report', 'yes')->where('category_id', $category_id)->count();
        $category_details = ReportCategory::where('status','=','active')->where('id',$category_id)->first();
        $report_categories = ReportCategory::where('status','=','active')->get();
        return view('front.upcoming_report.upcoming_report', compact('all_reports','category_details','report_categories','report_per_page','report_count'));
    }

    public function report_details($report_slug, $report_id){
        $research = Arm_research_methodology::where('status', '=', 'active')->first();
        $banner = Arm_research_methodology_banner::where('status', '=', 'active')->get();
        $report_details = Arm_reports::where('status','=','active')->where('id',$report_id)->where('upcoming_report', 'yes')->first();
        if(empty($report_details)){
            return redirect('/404');
        }
        $category_details = ReportCategory::where('status','=','active')->where('id',$report_details->category_id)->first();
        if(empty($category_details)){
            return redirect('/404');
        }
        // $related_reports = Arm_reports::where('status','=','active')->where('category_id',$report_details->category_id)->where('id','!=',$report_details->id)->where('upcoming_report', 'yes')->orderBy('id', 'desc')->take(5)->get();
        $related_reports = Arm_relate_report::where('status', 'active')->where('report_id', $report_details->id)->with('reports')->orderBy('id', 'desc')->get();
        return view('front.upcoming_report.upcoming_report_view', compact('report_details', 'category_details', 'related_reports', 'research', 'banner'));
    }
}
