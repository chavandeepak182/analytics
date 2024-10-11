<?php

namespace App\Http\Controllers\Front\get_a_quote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use App\Models\Get_a_quote;

class GetAQuoteController extends Controller
{
    use MediaTrait;

    public function index(){
        return view('front.get-a-quote');
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'mobile' => 'required|max:255',//|digits:10
    //         'company' => 'required|string|max:255',
    //         'country' => 'required',
    //         'services' => 'required',
    //         // 'budget' => 'required',
    //         'requirement' => 'required'
    //     ]);

    //     if ($request->has('file')){
    //         $request->validate([
    //             'file' => "mimes:pdf|required|max:1024",
    //         ], [
    //             'file.mimes' => 'File Must Be a PDF File',
    //             'file.required' => 'File is Required',
    //             'file.max' => 'File size must be less than 1 MB.',
    //         ]);
    //         $input['file_path'] = $this->verifyAndUpload($request, 'file', 'get-a-quote/file');
    //         $original_name = $request->file('file')->getClientOriginalName();
    //         $input['file_name'] = $original_name;
    //     }

    //     $input['name'] = $request->name;
    //     $input['email'] = $request->email;
    //     $code = $request->mcountry_code;
    //     $input['mobile'] = $code.$request->mobile;
    //     $input['company'] = $request->company;
    //     $input['country'] = $request->country;
    //     $input['budget'] = $request->budget;
    //     $input['services'] = $request->services;
    //     $input['requirement'] = $request->requirement;
    //     $input['created_by'] = '0';
    //     $input['created_ip_address'] = $request->ip();
    //     // dd($input['mobile']);
    //     Get_a_quote::create($input);
    //     return redirect()->back()->with('success', "Quote request submitted successfully. We'll be in touch soon.");
    // }


    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile' => 'required|max:255', //|digits:10
        'company' => 'required|string|max:255',
        'country' => 'required',
        'services' => 'required',
        // 'budget' => 'required',
        'requirement' => 'required',
        'captcha_form' => 'required|captcha',
    ],[
        'captcha_form.captcha' => 'Please Enter Correct Capcha',
    ]);

    // Check if the file is uploaded
    if ($request->has('file')) {
        $request->validate([
            'file' => 'mimes:pdf|required|max:1024',
        ], [
            'file.mimes' => 'File must be a PDF file',
            'file.required' => 'File is required',
            'file.max' => 'File size must be less than 1 MB.',
        ]);

        // Process and store the uploaded file
        $input['file_path'] = $this->verifyAndUpload($request, 'file', 'get-a-quote/file');
        $originalName = $request->file('file')->getClientOriginalName();
        $input['file_name'] = $originalName;
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


    // Assign data to the input array
    $input['name'] = $request->name;
    $input['email'] = $request->email;
    $code = $request->mcountry_code;
    $input['mobile'] = $code . $request->mobile;
    $input['company'] = $request->company;
    $input['country'] = $request->country;
    $input['budget'] = $request->budget;
    $input['services'] = $request->services;
    $input['requirement'] = $request->requirement;
    $input['created_by'] = '0';
    $input['created_ip_address'] = $request->ip();
    $input['browser'] = $browserName; // Add browser name to the input

    // Save data to the database
    Get_a_quote::create($input);

    // Redirect back with success message
    return redirect()->back()->with('success', "Quote request submitted successfully. We'll be in touch soon.");
}

}
