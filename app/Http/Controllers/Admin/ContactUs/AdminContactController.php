<?php

namespace App\Http\Controllers\Admin\ContactUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_contact_us_query;
use App\Models\Arm_role_privilege;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Auth;
use Crypt;
use Arr;
use Storage;
use App\Exports\ContactusExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminContactController extends Controller
{
    public function index()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'contact_enquiry_view')){
            return view('admin.contact_enquiry.contact_enquiry');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function  data_table(Request $request)
    {
        $contacts = Arm_contact_us_query::where('status', '!=', 'delete')->orderBy('id', 'desc')
        ->select('id', 'created_at', 'fname', 'lname', 'phone', 'email', 'company_name', 'message', 'created_ip_address', 'country')->get();
        if ($request->ajax()){
            return DataTables::of($contacts)
                ->addIndexColumn()

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

                ->addColumn('name', function ($row) {
                    if (!empty($row->fname)) {
                        return ucfirst($row->fname.' '.$row->lname);
                    }
                })

                ->addColumn('phone', function ($row) {
                    if (!empty($row->phone)) {
                        return ucfirst($row->phone);
                    }
                })

                ->addColumn('email', function ($row) {
                    if (!empty($row->email)) {
                        return ucfirst($row->email);
                    }
                })

                ->addColumn('company_name', function ($row){
                    if (!empty($row->company_name)){
                        return ucfirst($row->company_name);
                    }
                })

                ->addColumn('message', function ($row) {
                    return !empty($row->message) ? '<div class="scrollable-cell">' . mb_convert_encoding($row->message, "UTF-8") . '</div>': '';
                })

                ->addColumn('created_ip_address', function ($row){
                    $ip_address = !empty($row->created_ip_address) ? $row->created_ip_address : '' ;
                    $country = !empty($row->country) ? $row->country : '' ;
                    return $ip_address.'<br>'.$country;
                })

                ->addColumn('action', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'contact_enquiry_delete')){
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_contact_us_query" data-flash="Contact Details Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    } 
                    return $actionBtn;
                })

                ->rawColumns(['action','message','created_ip_address'])
                ->make(true);
        }
    }

    public function exportContactUs()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'contact_enquiry_view')){
            return Excel::download(new ContactusExport(), 'contact_us.xlsx');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }
}
