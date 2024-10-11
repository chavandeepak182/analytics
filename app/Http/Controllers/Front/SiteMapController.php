<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_reports;
use App\Models\ReportCategory;
use App\Models\Arm_blog;
use App\Models\Arm_infographics;

class SiteMapController extends Controller
{
    public function index(){
        $reports = Arm_reports::latest()->get();
        $upcoming_reports = Arm_reports::latest()->where('upcoming_report', 'yes')->get();
        $report_catgories = ReportCategory::latest()->get();
        $blogs = Arm_blog::latest()->where('type', 'blogs')->get();
        $press_release = Arm_blog::latest()->where('type', 'press_release')->get();
        $infographics = Arm_infographics::latest()->get();
        return response()->view('front.sitemap', [
            'reports' => $reports, 
            'report_catgories' => $report_catgories, 
            'upcoming_reports' => $upcoming_reports, 
            'blogs' => $blogs, 
            'press_release' => $press_release, 
            'infographics' => $infographics, 
        ])->header('Content-Type', 'text/xml');
    }
}
