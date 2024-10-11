<?php

namespace App\Http\Controllers\Admin\career;

use App\Exports\CareerApplicationExport;
use App\Http\Controllers\Controller;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use App\Models\Career_application;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class CnCareerAplicationController extends Controller
{
    use MediaTrait;
    public function index()
    {
        return view('admin.career.career_enquiry');
    }

    public function career_application_data_table(Request $request)
    {
        $career_applications = Career_application::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id', 'name', 'email', 'mobile', 'message', 'document_path', 'document_name','browser','created_ip_address', 'created_at')->get();

        if ($request->ajax()) {
            return DataTables::of($career_applications)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
                })
                ->addColumn('name', function ($row) {
                    if (!empty($row->name)) {
                        return ucfirst($row->name);
                    }
                })
                ->addColumn('email', function ($row) {
                    if (!empty($row->email)) {
                        return $row->email;
                    }
                })
                ->addColumn('mobile', function ($row) {
                    if (!empty($row->mobile)) {
                        return $row->mobile;
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
                ->addColumn('document', function ($row) {
                    if (!empty($row->document_path) && Storage::exists($row->document_path)) {
                        return '<a href="' . url('/') . Storage::url($row->document_path) . '" download><i class="fa fa-download"></i></a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="career_applications" data-flash="Application Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['document', 'action'])
                ->make(true);
        }
    }
    // public function career_application_store(Request $request)
    // {
    //     // return 'sdfd';
    //     // dd($request);
    //     $request->validate([
    //         'job_id' => 'required|string',
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'mobile' => 'required', //|digits:10
    //         'message' => 'required|string',
    //     ]);

    //     if ($request->has('document_path')){
    //         // $input['document_path'] = $this->verifyAndUpload($request, 'document_path', 'career-application/file');
    //         // $original_name = $request->file('document_path')->getClientOriginalName();
    //         // $input['document_name'] = $original_name;
    //         $input['document_path'] = $this->verifyAndUpload($request, 'document_path', 'career-application/file');
    //         $original_name = $request->file('document_path')->getClientOriginalName();
    //         $input['document_name'] = $original_name;
    //     }

    //     $input['job_id'] = $request->job_id;
    //     $input['name'] = $request->name;
    //     $input['email'] = $request->email;
    //     $input['mobile'] = $request->mobile;
    //     $input['subject'] = $request->subject;
    //     $input['message'] = $request->message;
    //     $input['created_by'] = '0';
    //     $input['created_ip_address'] = $request->ip();
    //     Career_application::create($input);
    //     return redirect()->back()->with('success', 'Job application submitted successfully. Thank you for applying!');
    // }

    public function career_application_store(Request $request)
    {
        // Validate the career application fields
        $request->validate([
            'job_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required', //|digits:10
            'message' => 'required|string',
            'captcha_form' => 'required|captcha',
        ],[
            'captcha_form.captcha' => 'Please Enter Correct Capcha',
        ]);

        if ($request->has('document_path')) {
            $input['document_path'] = $this->verifyAndUpload($request, 'document_path', 'career-application/file');
            $original_name = $request->file('document_path')->getClientOriginalName();
            $input['document_name'] = $original_name;
        }

        // Get browser information
        // $userAgent = $_SERVER['HTTP_USER_AGENT'];
        // $browser = get_browser($userAgent, true);
        // $browserName = $browser['browser'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

// Extracting browser name from the user agent string
// $userAgent = $_SERVER['HTTP_USER_AGENT'];


if (strpos($userAgent, 'Firefox') !== false) {
    $browserName = 'Mozilla Firefox';
} elseif (strpos($userAgent, 'OPR') !== false || strpos($userAgent, 'Opera') !== false) {
    $browserName = 'Opera';
} elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident/') !== false) {
    $browserName = 'Internet Explorer';
} elseif (strpos($userAgent, 'Edge') !== false) {
    $browserName = 'Microsoft Edge';
} elseif (strpos($userAgent, 'Edg') !== false) {
    $browserName = 'Microsoft Edge (Chromium-based)';
} elseif (strpos($userAgent, 'Brave') !== false) {
    $browserName = 'Brave';
} elseif (strpos($userAgent, 'Vivaldi') !== false) {
    $browserName = 'Vivaldi';
} elseif (strpos($userAgent, 'Flock') !== false) {
    $browserName = 'Flock';
} elseif (strpos($userAgent, 'UCBrowser') !== false || strpos($userAgent, 'UCWEB') !== false) {
    $browserName = 'UC Browser';
} elseif (strpos($userAgent, 'SamsungBrowser') !== false) {
    $browserName = 'Samsung Internet';
} elseif (strpos($userAgent, 'Chrome') !== false) {
    $browserName = 'Google Chrome';
} elseif (strpos($userAgent, 'Safari') !== false) {
    if (strpos($userAgent, 'CriOS') !== false) {
        $browserName = 'Google Chrome (on iOS)';
    } else {
        $browserName = 'Apple Safari';
    }
} else {
    $browserName = 'Unknown';
}


        // Assign input data including browser information
        $input['job_id'] = $request->job_id;
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['subject'] = $request->subject;
        $input['message'] = $request->message;
        $input['created_by'] = '0';
        $input['created_ip_address'] = $request->ip();
        $input['browser'] = $browserName; // Add browser name to the input

        Career_application::create($input);

        return redirect()->back()->with('success', 'Job application submitted successfully. Thank you for applying!');
    }

    public function exportcareers()
    {
        $careerapplications = Career_application::select('id', 'name', 'email', 'mobile', 'message','browser','created_ip_address', 'created_at')
            ->where('status', '!=', 'delete')
            ->get();
        return Excel::download(new CareerApplicationExport($careerapplications), 'career_applications.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

}
