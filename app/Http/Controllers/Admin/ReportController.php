<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use App\Models\Arm_reports;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportReports;
use App\Exports\ExportReport;
use Illuminate\Support\Facades\DB;
use App\Models\Arm_role_privilege;
use Auth;
use Crypt;
use Arr;
use Storage;
use Session;
use Validator;
use Str;
use Response;
use Carbon\Carbon;

use Throwable;

class ReportController extends Controller
{
    use MediaTrait;

    public function index(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_view')){
            $categories = ReportCategory::where('status','active')->get();
            $totalReportCount = Arm_reports::where('status','!=','delete')->count();
            $totalTopSellingReportCount = Arm_reports::where('status','!=','delete')->where('top_selling','yes')->count();
            $totaUpcomingReportCount = Arm_reports::where('status','!=','delete')->where('upcoming_report','yes')->count();
            return view('admin.all_reports.all_reports', compact('categories', 'totalReportCount', 'totalTopSellingReportCount', 'totaUpcomingReportCount'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
       
    }
    
    public function create(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_add')){
            $categories = ReportCategory::where('status','active')->get();
            return view('admin.all_reports.add_reports', compact('categories'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){

        $id = $request->id;

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'published_on' => 'required',
            'single_user_cost' => 'numeric',
            'multi_user_cost' => 'numeric',
            'enterprise_user_cost' => 'numeric',
            'image_1_path' => 'max:2048',
            'image_2_path' => 'max:2048',
            'image_3_path' => 'max:2048',
        ],[
            'category_id.required' => 'The Category Field Is Required',
            'image_1_path' => 'Image Size Must Be Less Than 2MB',
            'image_2_path' => 'Image Size Must Be Less Than 2MB',
            'image_3_path' => 'Image Size Must Be Less Than 2MB',
        ]);

        $input['category_id'] = implode(",",$request->category_id);
        $input['title'] = $request->title;
        // if(!empty($id)){
        //     if (Arm_reports::where('id','!=',$id)->where('status','!=','delete')->where('url', Str::slug($request->url))->exists()) {
        //         return redirect()->back()->withErrors(['url' => 'The URL is already taken.']);
        //     }else{
        //         $input['url'] = Str::slug($request->url);
        //     }
        // }else{
        //     if (Arm_reports::where('status','!=','delete')->where('url', Str::slug($request->url))->exists()) {
        //         return redirect()->back()->withErrors(['url' => 'The URL is already taken.']);
        //     }else{
        //         $input['url'] = Str::slug($request->url);
        //     }
        // }
        $input['url'] = Str::slug($request->url);
        $input['published_on'] = date('Y-m-d',strtotime($request->published_on));
        $input['keyword'] = $request->keyword;
        $input['total_pages'] = $request->total_pages;

        $input['single_user_cost'] = $request->single_user_cost;
        $input['multi_user_cost'] = $request->multi_user_cost;
        $input['enterprise_user_cost'] = $request->enterprise_user_cost;
        $input['base_year'] = $request->base_year;
        $input['estimated_year'] = $request->estimated_year;
        $input['historical_data'] = $request->historical_data;
        $input['forecast_period'] = $request->forecast_period;

        $input['description'] = $request->description;
        $input['table_of_content'] = $request->table_of_content;
        $input['research_methodology'] = $request->research_methodology;
        $input['infographics'] = $request->infographics;
        $input['meta_title'] = $request->meta_title;
        $input['meta_keyword'] = $request->meta_keyword;
        $input['meta_description'] = $request->meta_description;

        $input['faq_status'] = !empty($request->faq_status) ? $request->faq_status : 'inactive';
        $input['faq_question_1'] = $request->faq_question_1;
        $input['faq_question_2'] = $request->faq_question_2;
        $input['faq_question_3'] = $request->faq_question_3;
        $input['faq_question_4'] = $request->faq_question_4;
        $input['faq_question_5'] = $request->faq_question_5;
        $input['faq_answer_1'] = $request->faq_answer_1;
        $input['faq_answer_2'] = $request->faq_answer_2;
        $input['faq_answer_3'] = $request->faq_answer_3;
        $input['faq_answer_4'] = $request->faq_answer_4;
        $input['faq_answer_5'] = $request->faq_answer_5;    
        
        try{
            if ($request->has('image_1_path')){
                $input['image_1_path'] = $this->verifyAndUpload($request, 'image_1_path', 'images/report');
                $original_name = $request->file('image_1_path')->getClientOriginalName();
                $input['image_1_name'] = $original_name;
            }

            if ($request->has('image_2_path')){
                $input['image_2_path'] = $this->verifyAndUpload($request, 'image_2_path', 'images/report');
                $original_name = $request->file('image_2_path')->getClientOriginalName();
                $input['image_2_name'] = $original_name;
            }

            if ($request->has('image_3_path')){
                $input['image_3_path'] = $this->verifyAndUpload($request, 'image_3_path', 'images/report');
                $original_name = $request->file('image_3_path')->getClientOriginalName();
                $input['image_3_name'] = $original_name;
            }
        }
        catch(Throwable $e){
            return redirect()->back()->with('error', 'Please Try With Other Image');
        }


        if(!empty($id)){
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_reports::where('id', '=', $id)->update($input);
                return redirect('/admin/report')->with('success', 'Report Updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
        else{
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_add')){
                $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                if($response = Arm_reports::create($input)){
                    $prefix = "AMR_";
                    $suffix = sprintf("%08s", $response->id);
                    Arm_reports::where('id', $response->id)->update(array("report_id" => $prefix.$suffix));
                }
                return redirect('/admin/report')->with('success', 'Report added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }

    }

    public function report_data_table(Request $request){
        $reports = Arm_reports::where('arm_reports.status', '!=', 'delete')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->orderBy('arm_reports.id', 'DESC');
        if(!empty($request->category_id)){
            $reports = $reports->where('arm_reports.category_id', $request->category_id);
        }
        if(!empty($request->fromdate)){
            $reports = $reports->whereDate('arm_reports.published_on', '>=', date('Y-m-d',strtotime($request->fromdate)));
        }
        if(!empty($request->todate)){
            $reports = $reports->whereDate('arm_reports.published_on', '<=', date('Y-m-d',strtotime($request->todate)));
        }
        $currentPage = ($request->start / $request->length) + 1;
        $skip = ($currentPage - 1) * $request->length;
        $reports = $reports->select('arm_reports.id', 'arm_reports.report_id', 'arm_reports.title', 'arm_reports.publisher', 'arm_reports.url', 'arm_reports.published_on','arm_reports.category_id', 'arm_report_categories.category_name', 'arm_reports.status', 'arm_reports.top_selling', 'arm_reports.upcoming_report')->skip($skip)->take($request->length)->get();
        $totalRecords = Arm_reports::where('arm_reports.status', '!=', 'delete')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->count();
        if ($request->ajax()) {
            $datatables = DataTables::of($reports)
                ->addIndexColumn()

                ->addColumn('report_id', function($row){
                    return!empty($row->report_id) ? $row->report_id : '';
                })

                ->addColumn('upcoming_report', function($row){
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
                        if ($row->upcoming_report == 'yes') {
                            $upcomingReportStatusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Upcoming Report Status Changed Successfully!"  class="upcoming-report" ><i class="fa fa-check-square-o text-success upcoming_report_button" aria-hidden="true" title=""></i></a>';
                            return $upcomingReportStatusActiveBtn;
                        } else {
                            $upcomingReportStatusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Upcoming Report Status Changed Successfully!" class="upcoming-report" ><i class="fa fa-check-square-o text-danger upcoming_report_button" aria-hidden="true" title=""></></a>';
                            return $upcomingReportStatusBlockBtn;
                        }
                    } else {
                        if ($row->upcoming_report == 'yes') {
                            $upcomingReportStatusActiveBtn = '<a href="javascript;)" disabled><i class="fa fa-check-square-o text-success upcoming_report_button" aria-hidden="true" title=""></i></a>';
                            return $upcomingReportStatusActiveBtn;
                        } else {
                            $upcomingReportStatusBlockBtn = '<a href="javascript:;" disabled><i class="fa fa-check-square-o text-danger upcoming_report_button" aria-hidden="true" title=""></></a>';
                            return $upcomingReportStatusBlockBtn;
                        }
                    }
                })
                ->addColumn('top_selling_report', function($row){
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
                        if ($row->top_selling == 'yes') {
                            $topSellingStatusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Top selling Status Changed Successfully!"  class="change-top-selling" ><i class="fa fa-check-circle text-success top_selling_button" aria-hidden="true" title=""></i></a>';
                            return $topSellingStatusActiveBtn;
                        } else {
                            $topSellingStatusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Top selling Status Changed Successfully!" class="change-top-selling" ><i class="fa fa-check-circle text-danger top_selling_button" aria-hidden="true" title=""></></a>';
                            return $topSellingStatusBlockBtn;
                        }
                    } else {
                        if ($row->top_selling == 'yes') {
                            $topSellingStatusActiveBtn = '<a href="javascript:;" disabled><i class="fa fa-check-circle text-success top_selling_button" aria-hidden="true" title=""></i></a>';
                            return $topSellingStatusActiveBtn;
                        } else {
                            $topSellingStatusBlockBtn = '<a href="javascript:;" disabled><i class="fa fa-check-circle text-danger top_selling_button" aria-hidden="true" title=""></></a>';
                            return $topSellingStatusBlockBtn;
                        }
                    }
                })
                ->addColumn('title', function($row){
                    return!empty($row->title) ? "<div class='scrollable-cell'>".$row->title."</div>" : '';
                })
                ->addColumn('category_name', function($row){
                    // return!empty($row->category_name) ? ucfirst($row->category_name) : '';
                    $category_name = array();
                    if(!empty($row->category_id)){
                        $categories = ReportCategory::where('status','active')->select('id', 'category_name')->get();
                        foreach($categories as $category){
                            if(in_array($category->id, explode(",", $row->category_id))){
                                array_push($category_name, " ".$category->category_name." ");
                            }
                        }
                    }
                    return implode(",",$category_name);
                })
                ->addColumn('publisher', function($row){
                    return!empty($row->publisher) ? ucfirst($row->publisher) : '';
                })

                ->addColumn('url', function($row){
                    return '<a href="'.url('/reports/'.$row->url.'/'.$row->id).'" target="_blank"> '. url('/reports').'/'.$row->url.'/'.$row->id .'</a>';
                })

                ->addColumn('published_on', function($row){
                    return !empty($row->published_on) ? date('d-m-Y', strtotime($row->published_on)) : '';
                })
                
                ->addColumn('related_report', function($row){
                    $related_report = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_view')){
                        $related_report .= '<a href="' . url('admin/report/related-reports/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-eye"></i></button></a>';
                    } else {
                        $related_report .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-eye"></i></button></a>';
                    }
                    return $related_report;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
                        $actionBtn .= '<a href="' . url('admin/report/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_reports" data-flash="Report Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a></div>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                
                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Status Changed Successfully!"  class="change-status" status="'.$row->status.'"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_reports" data-flash="Status Changed Successfully!" class="change-status" status="'.$row->status.'" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->skipPaging()
                ->rawColumns(['action','status','top_selling_report','upcoming_report', 'url', 'title', 'related_report'])
                ->make(true);
            $response = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $datatables->getData(),
            ];
            return $response;
        }
    }

    public function change_top_selling_report_status(Request $request){
        $top_selling_status = DB::table($request->table)->where('id', $request->id)->value('top_selling');
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
            if ($top_selling_status == 'yes') {
                $block_status = DB::table($request->table)->where('id', $request->id)->update([
                    'top_selling' => 'no',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);
                $user_status = "no";
            } 
            else 
            {
                $active_status = DB::table($request->table)->where('id', $request->id)->update([
                    'top_selling' => 'yes',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);
                $user_status = "yes";
            }
            $totalTopSellingReportCount = Arm_reports::where('status','!=','delete')->where('top_selling','yes')->count();
            return response()->json(['message' => $request->flash, 'user_status' => $user_status, 'status' => 'true', 'topSellingReportCount'=>$totalTopSellingReportCount]);
        } else {
            return response()->json(['message' => 'Sorry, You Have No Permission For This Request!']);
        }
    }

    public function change_upcoming_report_status(Request $request){
        $upcoming_report_status = DB::table($request->table)->where('id', $request->id)->value('upcoming_report');
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
            if ($upcoming_report_status == 'yes') {
                $block_status = DB::table($request->table)->where('id', $request->id)->update([
                    'upcoming_report' => 'no',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);
                $user_status = "no";
            } 
            else 
            {
                $active_status = DB::table($request->table)->where('id', $request->id)->update([
                    'upcoming_report' => 'yes',
                    'modified_by' => Auth::guard('arm_admins')->user()->id,
                    'modified_ip_address' => $_SERVER['REMOTE_ADDR']
                ]);
                $user_status = "yes";
            }
            $totaUpcomingReportCount = Arm_reports::where('status','!=','delete')->where('upcoming_report','yes')->count();
            return response()->json(['message' => $request->flash, 'user_status' => $user_status, 'status' => 'true', 'upcomingReportCount'=>$totaUpcomingReportCount]);
        } else {
            return response()->json(['message' => 'Sorry, You Have No Permission For This Request!']);
        }
    }

    public function edit($id){
        try {
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_edit')){
                $report = Arm_reports::find(Crypt::decrypt($id));
                $categories = ReportCategory::where('status','active')->get();
                return view('admin.all_reports.add_reports', compact('report','categories'));
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/report')->with('error', 'Access Denied !');
        }
    }

    public function report_import(Request $request){
        if ($request->hasFile('import_report')) { 

            $validator=Validator::make($request->all(),[
                'import_report'=>'required|mimes:xlsx,xls,csv|max:2048'
            ]); 

            if ($validator->fails()) {
                return back()->with('error', 'oops, inavlid file types');
            }
            else{
                $role_id = Auth::guard('arm_admins')->user()->role_id;
                $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_other')){
                    $importError = array();
                    Excel::import(new ImportReports, request()->file('import_report'));
                    $importError = Session::get('message_data');
                    Session::forget('message_data');
                    if(!empty($importError[0]['error'])){
                        return back()->with('error', 'Title or Url for some row may exist in database or may empty url, rest imported succesfully');
                    }
                    return back()->with('success', 'Excel Imported Successfully');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }

    }

    public function report_export(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_other')){
            $all_reports = Arm_reports::where('arm_reports.status', '!=', 'delete')->join('arm_report_categories', 'arm_report_categories.id','=','arm_reports.category_id')->orderBy('arm_reports.id', 'desc');
            if(!empty($request->category_id)){
                $all_reports = $all_reports->where('arm_reports.category_id', $request->category_id);
            }
            if(!empty($request->fromdate)){
                $all_reports = $all_reports->whereDate('arm_reports.published_on', '>=', date('Y-m-d',strtotime($request->fromdate)));
            }
            if(!empty($request->todate)){
                $all_reports = $all_reports->whereDate('arm_reports.published_on', '<=', date('Y-m-d',strtotime($request->todate)));
            }
            $all_reports = $all_reports->select('arm_reports.*','arm_report_categories.category_name')->get();
            return Excel::download(new ExportReport($all_reports), 'reports.xlsx');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function downloadSampleReport(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_other')){
            $file= public_path('admin_panel/download/sample-report.xlsx');
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
            return response()->file($file, $headers);
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function check_url_exists(Request $request){
        if(!empty($request->report_id)){
            if(Arm_reports::where('id','!=',$request->report_id)->where('status','!=','delete')->where('url', Str::slug($request->url))->exists()){
                return "true";
            } else {
                return "false";
            }
        } else {
            if(Arm_reports::where('status','!=','delete')->where('url', Str::slug($request->url))->exists()){
                return true;
            } else {
                return false;
            }
        }
    }

    function store_published_date(){
        set_time_limit(0);
        $published_on = '9/1/2022';
        $set_published_on = '2022-09-01';
        $all_reports = Arm_reports::where('published_on', $published_on)->get();
        // dd($all_reports);
        foreach($all_reports as $report){
            // $date = str_replace('/', '-', $report->published_on);
            // $date = date("Y-m-d", strtotime($date));
            Arm_reports::where('id',$report->id)->update(array('published_on_2' => $set_published_on));
        }
        dd("success");
    }

    // public function store_report_url(){
    //     function extractString($inputString) {
    //         if (strpos($inputString, 'Global') === 0) {
    //             $marketSizePos = strpos($inputString, 'Size');
    //             if ($marketSizePos !== false) {
    //                 $outputString = substr($inputString, 6, $marketSizePos - 6);
    //                 return $outputString;
    //             } else {
    //                 return substr($inputString, 6);
    //             }
    //         } else {
    //             $keyword = 'Market';
    //             $position = strpos($inputString, $keyword);
                
    //             if ($position !== false) {
    //                 $result = substr($inputString, 0, $position + strlen($keyword));
    //                 return $result;
    //             } else {
    //                 return substr($inputString, 6);
    //             }
    //         }
    //     }
    //     // $string = "Trifluoperazine Market Analysis By Type (Tablet, Syrup); Application (Psychosis, Schizophrenia, Acute Non-Psychotic Anxiety) & Forecast 2023-2032";
    //     // dd(extractString($string));

    //     set_time_limit(0);
    //     $reports = Arm_reports::where('url', ' ')->get();
    //     foreach ($reports as $report) {
    //         $url = str::slug(extractString($report->title));
    //         Arm_reports::where('id', $report->id)->update(['url' => $url]);
    //     }
    //     dd("success");
    // }

    // public function store_report_id(){
    //     set_time_limit(0);
    //     Arm_reports::chunk(1000, function ($reports) {
    //         foreach ($reports as $report) {
    //             $prefix = "AMR_";
    //             $suffix = sprintf("%08s", $report->id);
    //             $newReportId = $prefix . $suffix;
    
    //             // Update the report_id field for the current record
    //             Arm_reports::where('id', $report->id)->update(['report_id' => $newReportId]);
    //         }
    //     });
    
    //     dd("success");
    // }
}
