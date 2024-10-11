<?php

namespace App\Http\Controllers\Admin\contact_us;

use App\Exports\CareerApplicationExport;
use App\Exports\ContactUsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\LandingContactUs;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CnContactUsController extends Controller
{
    public function index()
    {
        return view('admin.contact.contact');
    }
    public function landing_index()
    {
        return view('admin.contact.landing-contact');
    }

    public function contact_data_table(Request $request)
    {
        $contact_us = ContactUs::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id', 'name', 'email', 'mobile', 'subject', 'message', 'browser', 'created_ip_address', 'created_at')->get();

        if ($request->ajax()) {
            return DataTables::of($contact_us)
                ->addIndexColumn()
                
                ->addColumn('select', function ($row) {
                    return '<input type="checkbox" class="user_checkbox" name="user_checkbox" value="' . $row->id . '   " data-id="' . $row->id . '">';
                })
             
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
                })
                ->addColumn('name', function ($row) {
                    if (!empty($row->name)) {
                        return ucfirst($row->name);
                    }
                })
                ->addColumn('mobile', function ($row) {
                    if (!empty($row->mobile)) {
                        return $row->mobile;
                    }
                })
                ->addColumn('email', function ($row) {
                    if (!empty($row->email)) {
                        return $row->email;
                    }
                })
                ->addColumn('subject', function ($row) {
                    if (!empty($row->subject)) {
                        return ucfirst($row->subject);
                    }
                })
                ->addColumn('message', function ($row) {
                    if (!empty($row->message)) {
                        return ucfirst($row->message);
                    }
                })
                ->addColumn('created_by', function ($row) {
                    if (!empty($row->created_by)) {
                        return ucfirst($row->created_by);
                    }
                })
                ->addColumn('browser', function ($row) {
                    if (!empty($row->browser)) {
                        return ucfirst($row->browser);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="contact_us" data-flash="Contact Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','select'])
                ->make(true);
        }
    }
    public function landing_contact_data_table(Request $request)
    {
        $contact_us = LandingContactUs::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('*')->get();

        if ($request->ajax()) {
            return DataTables::of($contact_us)
                ->addIndexColumn()
                ->addColumn('select', function ($row) {
                    return '<input type="checkbox" class="user_checkbox" name="user_checkbox" value="' . $row->id . '   " data-id="' . $row->id . '">';
                })
                
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
                })
                ->addColumn('name', function ($row) {
                    if (!empty($row->name)) {
                        return ucfirst($row->name);
                    }
                })
                ->addColumn('mobile', function ($row) {
                    if (!empty($row->contact)) {
                        return $row->contact;
                    }
                })
                ->addColumn('email', function ($row) {
                    if (!empty($row->e_mail)) {
                        return $row->e_mail;
                    }
                })
                ->addColumn('message', function ($row) {
                    if (!empty($row->message)) {
                        return ucfirst($row->message);
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="landing_contact_us" data-flash="Contact Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','select'])
                ->make(true);
        }
    }
    public function exportcontacts()
    {
        $contactus = ContactUs::select('id', 'name', 'email', 'mobile', 'message', 'subject', 'browser', 'created_ip_address', 'created_at')
            ->where('status', '!=', 'delete')
            ->get();
        return Excel::download(new ContactUsExport($contactus), 'contact_us.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    
    public function deleteSelected(Request $request)
    {
        

        $deleted = ContactUs::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function deletelandingSelected(Request $request)
    {
      
        $deleted = LandingContactUs::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }
}


// url: "{{ url('admin/contact/deleteSelected') }}",