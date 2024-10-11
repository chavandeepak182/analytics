<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Models\Arm_reports;
use App\Models\Arm_relate_report;
use App\Models\Arm_role_privilege;
use Yajra\DataTables\DataTables;
use Auth;
use Crypt;
use Session;

class RelatedReportController extends Controller
{
    public $report_id;

    public function index(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_view')){
            $report_id = $request->id;
            session()->put('report_id', $request->id);
            $categories = ReportCategory::where('status', 'active')->get();
            $reports = Arm_reports::where('status', 'active')->orderBy('id', 'desc')->get();
            $report_details = Arm_reports::where('status', '!=', 'delete')->where('id', $request->id)->first();
            if(empty($report_details)){
                return redirect('/404');
            }
            return view('admin.all_reports.related_reports', compact('report_id', 'categories', 'reports', 'report_details'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){
        $request->validate([
            'related_report_id' => 'required'
        ]);

        $input['report_id'] = $request->report_id;
        $input['related_report_id'] = $request->related_report_id;

        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_add')){
            if(Arm_relate_report::create($input)){
                return redirect()->back()->with('success', 'Related Report Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry, Something Went Wrong');
            }
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function related_report_data_table(Request $request){
        $related_reports = Arm_relate_report::where('status', '!=', 'delete')->where('report_id', session()->get('report_id'))->select('id', 'report_id', 'related_report_id', 'status')->with('reports')->orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($related_reports)
                ->addIndexColumn()

                ->addColumn('related_report_title', function($row){
                    return !empty($row->reports->title) ? "<div class='scrollable-cell'>".$row->reports->title."</div>"  : '';
                })
                ->addColumn('category', function($row){
                    if(!empty($row->reports->category_id)){
                        $category_name = "";
                        foreach(explode("," , $row->reports->category_id) as $category_id ){
                            $category_name .= $this->getCategoryNameById($category_id).", ";
                        }
                    }
                    return $category_name;
                })
                ->addColumn('report_url', function($row){
                    return !empty($row->reports->url) ? '<a href="'. url('/reports/'.$row->reports->url.'/'.$row->reports->id) .'">'.url('/reports/'.$row->reports->url.'/'.$row->reports->id).'</a>' : '';
                })
                ->addColumn('status', function($row){
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_relate_reports" data-flash="Status Changed Successfully!"  class="change-status" status="'.$row->status.'"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_relate_reports" data-flash="Status Changed Successfully!" class="change-status" status="'.$row->status.'" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->addColumn('action', function($row){
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_delete')){
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_relate_reports" data-flash="Related Report Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a></div>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                    }
                })

                ->rawColumns(['action', 'status', 'report_url', 'related_report_title'])
                ->make(true);
        }
    }

    public function get_reports_in_ctaegory(Request $request){
        return Arm_reports::where('status', 'active')->where('category_id', $request->category_id)->select('id', 'title')->orderBy('id', 'desc')->get();
    }

    public function getCategoryNameById($id){
        $cat_name = ReportCategory::where('status','!=','delete')->where('id',$id)->select('category_name')->first();
        return $cat_name->category_name;
    }
}
