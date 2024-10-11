<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_enquiry;
use Yajra\DataTables\DataTables;
use Crypt;
use Carbon\Carbon;
use App\Exports\EnqueryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Arm_role_privilege;
use Auth;

class EnquiryController extends Controller
{
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'enquiries_view')){
            return view('admin.enquiry.enquiry'); 
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function enquiry_data_table(Request $request) {
        $enquiry = Arm_enquiry::where('status', '!=', 'delete');
        if(!empty($request->request_type)){
            $enquiry = $enquiry->where('request_type', $request->request_type);
        }
        $enquiry = $enquiry->orderBy('id', 'DESC')->select('id','request_type','report_title','created_at','name', 'email', 'mobile_number', 'company_name', 'message','created_ip_address', 'country')->get();

        if ($request->ajax()) {
            return DataTables::of($enquiry)
                ->addIndexColumn()

                ->addColumn('request_type', function ($row) {
                    $request_type = !empty($row->request_type) ? $row->request_type: '';
                    foreach(config('constant.request_type_slug') as $key => $value){
                        if($request_type == $key){
                            $request_type = $value;
                        }
                    }
                    return $request_type;
                })
                ->addColumn('report_title', function ($row) {
                    return !empty($row->report_title) ? "<div class='scrollable-cell'>".$row->report_title."</div>": '';
                })

                ->addColumn('created_at', function ($row) {
                    if (!empty($row->created_at)) {
                        $date_time_str = $row->created_at;
                        $date_time_obj = Carbon::createFromFormat('Y-m-d H:i:s', $date_time_str);

                        // Extract day, month, and year
                        $day = $date_time_obj->format('d');
                        $month = $date_time_obj->format('F');
                        $year = $date_time_obj->format('Y');

                        // Format the date as "31 July 2023"
                        $formatted_date = $day . ' ' . $month . ' ' . $year;
                        return $formatted_date;
                    }
                })
                ->addColumn('name', function($row){
                    return !empty($row->name) ? ucfirst($row->name) : '';
                })
                ->addColumn('email', function($row){
                    return!empty($row->email) ? ucfirst($row->email) : '';
                })
                ->addColumn('mobile_number', function($row){
                    return!empty($row->mobile_number) ? $row->mobile_number : '';
                })

                ->addColumn('company_name', function($row){
                    return !empty($row->company_name) ? $row->company_name : '';
                })

                ->addColumn('message', function($row){
                    return !empty($row->message) ? $row->message : '';
                })

                ->addColumn('created_ip_address', function ($row) {
                    $ip_address = !empty($row->created_ip_address) ? $row->created_ip_address : '' ;
                    $country = !empty($row->country) ? $row->country : '' ;
                    return $ip_address.'<br>'.$country;
                })


                ->addColumn('action', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'enquiries_delete')){
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_enquiries" data-flash="Enquiry Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->rawColumns(['action', 'report_title', 'created_ip_address'])
                ->make(true);
        }
    }

    public function exportEnqueryData(Request $request)
    {
        $enquiry = Arm_enquiry::where('status', '!=', 'delete');
        if (!empty($request->request_type)) {
            $enquiry = $enquiry->where('request_type', $request->request_type);
        }
        $enquiry = $enquiry->orderBy('id', 'DESC')->select('id', 'request_type', 'report_title', 'created_at', 'name', 'email', 'mobile_number', 'company_name', 'message', 'created_ip_address')->get();
        
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'enquiries_other')){
            return Excel::download(new EnqueryExport($enquiry), 'enquiry.xlsx');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
        
    }
}
