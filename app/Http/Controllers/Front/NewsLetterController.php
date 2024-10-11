<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_news_letter;
use App\Models\Arm_general_settings;
use App\Mail\MailToAdminNewsLetter;
use App\Mail\MailToUserNewsLetter;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Stevebauman\Location\Facades\Location;
use App\Models\Arm_role_privilege;
use Auth;

use App\Models\Arm_payment_detail;
use App\Models\Arm_enquiry;
use App\Models\Arm_contact_us_query;
use App\Models\Arm_career_application;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use App\Mail\ExceptionOccured;
use Throwable;

class NewsLetterController extends Controller
{
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'subscriber_view')){
            return view('admin.subscriber.subscriber');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function  data_table(Request $request)
    {
        $subscriber = Arm_news_letter::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id', 'email', 'created_ip_address', 'country')->get();
        if ($request->ajax()) {
            return DataTables::of($subscriber)
                ->addIndexColumn()

                ->addColumn('email', function ($row) {
                    if (!empty($row->email)) {
                        return ucfirst($row->email);
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
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'subscriber_delete')){
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_news_letters" data-flash="Subscriber Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn = '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->rawColumns(['action', 'created_ip_address'])
                ->make(true);
        }
    }

    public function store(Request $request){
        $request->validate([
            'newsletter_email' => 'required|email'
        ]);

        $input['email'] = $request->newsletter_email;
        $currentUserInfo = $request->ip() != "127.0.0.1" ? Location::get($request->ip()) : false;
        $input['country'] = $currentUserInfo ? $currentUserInfo->countryName : '' ;
        $input['created_ip_address'] = $request->ip();
        $input['created_by'] = "100";

        $mailData = [
            'email' => $input['email'],
            'ip_address' => $request->ip(),
        ];

        $sales_email = Arm_general_settings::get('email')->first();
        Arm_news_letter::create($input);
        try{
            Mail::to($sales_email)->send(new MailToAdminNewsLetter($mailData)); // Mail to Admin
            Mail::to($request->newsletter_email)->send(new MailToUserNewsLetter($mailData)); // Mail to User
        } catch(Throwable $e){
            return redirect()->back()->with('warning', 'Thank You ! Your Request Reached To Us, Mail Not Send , Make Sure Email is Right Or Network Connection is Proper');
        }
        return redirect()->back()->with("success", "Thank You ! Your Request Reached To Us ");
            
    }

    public function store_newsletters_country(){
        $news_letter = Arm_news_letter::all();
        foreach($news_letter as $news){
            $currentUserInfo = (!empty($news->created_ip_address) && $news->created_ip_address) ? Location::get($news->created_ip_address) : false;
            $country_name = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            Arm_news_letter::where('id', $news->id)->update(['country' => $country_name]);
        }
        dd("success");
    }
    public function store_paymentdetails_country(){
        $news_letter = Arm_payment_detail::all();
        foreach($news_letter as $news){
            $currentUserInfo = (!empty($news->created_ip_address) && $news->created_ip_address) ? Location::get($news->created_ip_address) : false;
            $country_name = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            Arm_payment_detail::where('id', $news->id)->update(['country' => $country_name]);
        }
        dd("success");
    }
    public function store_enqiries_country(){
        $news_letter = Arm_enquiry::all();
        foreach($news_letter as $news){
            $currentUserInfo = (!empty($news->created_ip_address) && $news->created_ip_address) != "127.0.0.1" ? Location::get($news->created_ip_address) : false;
            $country_name = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            Arm_enquiry::where('id', $news->id)->update(['country' => $country_name]);
        }
        dd("success");
    }
    public function store_contactus_country(){
        $news_letter = Arm_contact_us_query::all();
        foreach($news_letter as $news){
            $currentUserInfo = (!empty($news->created_ip_address) && $news->created_ip_address) ? Location::get($news->created_ip_address) : false;
            $country_name = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            Arm_contact_us_query::where('id', $news->id)->update(['country' => $country_name]);
        }
        dd("success");
    }
    public function store_careerenquiry_country(){
        $news_letter = Arm_career_application::all();
        foreach($news_letter as $news){
            $currentUserInfo = (!empty($news->created_ip_address) && $news->created_ip_address) ? Location::get($news->created_ip_address) : false;
            $country_name = $currentUserInfo ? $currentUserInfo->countryName : '' ;
            Arm_career_application::where('id', $news->id)->update(['country' => $country_name]);
        }
        dd("success");
    }
}
