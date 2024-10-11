<?php

namespace App\Http\Controllers\Admin\Career_application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_career_application;
use Validator;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;
use Auth;
use Crypt;
use Arr;
use Storage;
use Mail;
use App\Mail\CareerAplicationMail;
use App\Mail\CareerThankYouMail;
use Carbon\Carbon;
use App\Exports\CarrerApplicationExport;
use App\Models\Arm_role_privilege;
use Maatwebsite\Excel\Facades\Excel;
use Stevebauman\Location\Facades\Location;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use App\Mail\ExceptionOccured;
use Throwable;

class CareerApplicationController extends Controller
{
    use MediaTrait;
     
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'career_applicant_view')){
            return view('admin.career_applicant.career_applicant');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }    
      
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|',
            'phone' => 'required|numeric',
            'file_path' => 'max:2048',
        ]);
        if($validator->passes()){
            if ($request->has('file_path')) {
                $input['file_path'] = $this->verifyAndUpload($request, 'file_path', 'file/resume');
                $original_name = $request->file('file_path')->getClientOriginalName();
                $input['file_name'] = $original_name;
            }
            $input['application_for'] = $request->application_for;
            $input['name'] = $request->name;
            $input['email'] = $request->email;
            $input['phone'] = $request->phone;
            $input['message'] = $request->message;
            $currentUserInfo = $request->ip() != "127.0.0.1" ? Location::get($request->ip()) : false;
            $input['country'] = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            $input['created_ip_address'] = $request->ip();
            $data = Arm_career_application::create($input);
            if (!empty($data)) {
                $mailData = [
                    'application_for' =>$input['application_for'],
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'message' => $input['message'],
                ];
                try{
                    \Mail::to('noreply@wemarketresearch.com')->send(new CareerAplicationMail($mailData));
                    \Mail::to($input['email'])->send(new CareerThankYouMail($mailData));
                }catch (Throwable $e) {
                    return redirect()->back()->with('warning', 'Thank You ! Your Request Reached To Us, Mail Not Send , Make Sure Email is Right Or Network Connection is Proper');
                }
                return redirect()->back()->with('success', 'Thank You ! Your Request Reached To Us');
            }else {
                return redirect()->back()->with('error', 'Something Error');
            }
        }else{
            // $messages = "";
            // foreach($validator->messages()->toarray() as $key => $value){
            //     if($key === "file_path"){
            //         $messages .= $value[1]." ";
            //     }else{
            //         $messages .= $value[0]." ";
            //     }
            // } 
            return redirect()->back()->with('error', $validator->messages());
        }
    }

    public function  data_table(Request $request)
    {
        $career_application =Arm_career_application::where('status', '!=', 'delete')->orderBy('id', 'DESC')
        ->select('id', 'created_at','application_for','name','email','phone','message','file_name','file_path', 'created_ip_address', 'country')
        ->get();

        if ($request->ajax()) {

            return DataTables::of($career_application)
                ->addIndexColumn()

                ->addColumn('application_for', function ($row) {
                    if (!empty($row->application_for)) {
                        return ucfirst($row->application_for);
                    }
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

                ->addColumn('name', function ($row){
                    if (!empty($row->name)) {
                        return ucfirst($row->name);
                    }
                })

                ->addColumn('email', function ($row) {
                    if (!empty($row->email)) {
                        return ucfirst($row->email);
                    }
                })

                ->addColumn('phone', function ($row) {
                    if (!empty($row->phone)) {
                        return ucfirst($row->phone);
                    }
                })

                ->addColumn('message', function ($row) {
                    if (!empty($row->message)) {
                        return '<div class="scrollable-cell">' . ucfirst($row->message) . '</div>';
                    }
                })

                ->addColumn('created_ip_address', function ($row) {
                    $ip_address = !empty($row->created_ip_address) ? $row->created_ip_address : '' ;
                    $country = !empty($row->country) ? $row->country : '' ;
                    return $ip_address.'<br>'.$country;
                })

                ->addColumn('file_path', function ($row) {
                    return !empty($row->file_path) ? '<a href="' . url('/') . Storage::url($row->file_path) . '" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : '';
                })

                ->addColumn('action', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'career_applicant_delete')){
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="career_application" data-flash="Career Application Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->rawColumns(['action', 'status', 'file_path', 'message', 'created_ip_address'])
                ->make(true);
        }
    }

    public function exportCareerApplication()
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'career_applicant_other')){
            return Excel::download(new CarrerApplicationExport(), 'carreraplication.xlsx');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }
}
