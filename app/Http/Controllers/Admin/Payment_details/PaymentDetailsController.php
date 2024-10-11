<?php

namespace App\Http\Controllers\Admin\Payment_details;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Arm_payment_detail;
use App\Models\Arm_enquiry;
use App\Models\Arm_role_privilege;
use Auth;
use Crypt;
use Arr;
use Storage;
use App\Exports\PaymentDetailExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentDetailsController extends Controller
{
   public function index(){
      $role_id = Auth::guard('arm_admins')->user()->role_id;
      $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
      if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'payment_transaction_details_view')){
         return view('admin.payment_transaction_details.payment_transaction_details');
      } else {
         return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
      } 
   }

   public function  data_table(Request $request)
   {
      $payments = Arm_payment_detail::where('status', '!=', 'delete')
         ->select('id','created_at','report_name','user_name', 'user_email', 'user_mobile','payment_method','payment_status', 'payment_id', 'report_price', 'license_type', 'created_ip_address', 'country')
         ->orderBy('id', 'DESC')
         ->get();

      if ($request->ajax()) {

         return DataTables::of($payments)
            ->addIndexColumn()

            ->addColumn('created_at', function ($row) {
               if (!empty($row->created_at)) {
                  return date('d-m-Y',strtotime($row->created_at));
               }
            })

            ->addColumn('report_name', function ($row) {
               if (!empty($row->report_name)) {
                  return "<div class='scrollable-cell' >".$row->report_name."</div>";
               }
            })

            ->addColumn('user_name', function ($row) {
               if (!empty($row->user_name)) {
                  return ucfirst($row->user_name);
               }
            })

            ->addColumn('user_email', function ($row) {
               if (!empty($row->user_email)) {
                  return ucfirst($row->user_email);
               }
            })

            ->addColumn('user_mobile', function ($row) {
               if (!empty($row->user_mobile)) {
                  return ucfirst($row->user_mobile);
               }
            })

            ->addColumn('payment_method', function ($row) {
               if (!empty($row->payment_method)) {
                  return ucfirst($row->payment_method);
               }
            })

            ->addColumn('payment_status', function ($row) {
               if (!empty($row->payment_status)) {
                  return ucfirst($row->payment_status);
               }
            })

            ->addColumn('payment_id', function ($row) {
               if (!empty($row->payment_id)) {
                  return ucfirst($row->payment_id);
               }
            })

            ->addColumn('report_price', function ($row) {
               if (!empty($row->report_price)) {
                  return ucfirst($row->report_price);
               }
            })

            ->addColumn('license_type', function ($row) {
               if (!empty($row->license_type)) {
                  return ucfirst($row->license_type);
               }
            })
            ->addColumn('created_ip_address', function ($row) {
               $ip_address = !empty($row->created_ip_address) ? $row->created_ip_address : '' ;
               $country = !empty($row->country) ? $row->country : '' ;
               return $ip_address.'<br>'.$country;
            })

            ->addColumn('action', function ($row) {
               $role_id = Auth::guard('arm_admins')->user()->role_id;
               $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
               if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'payment_transaction_details_delete')){
                  $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_payment_details" data-flash="Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
               } else {
                  $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
               } 
               return $actionBtn;
            })

            ->rawColumns(['action', 'report_name', 'created_ip_address'])
            ->make(true);
      }
   }

   public function exportPaymentDetails()
   {
      $role_id = Auth::guard('arm_admins')->user()->role_id;
      $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
      if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'payment_transaction_details_other')){
      $payment_details = Arm_payment_detail::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
      return Excel::download(new PaymentDetailExport($payment_details), 'Payment_details.xlsx');
      } else {
         return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
      } 
   }
}
