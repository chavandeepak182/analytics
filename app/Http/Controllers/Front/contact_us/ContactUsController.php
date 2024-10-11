<?php

namespace App\Http\Controllers\Front\contact_us;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index(){
        return view('front.contact');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'mobile' => 'required',        //|digits:10
    //         'subject' => 'required|string',
    //     ]);

    //     $input['name'] = $request->name;
    //     $input['email'] = $request->email;
    //     $input['mobile'] = $request->mobile;
    //     $input['subject'] = $request->subject;
    //     $input['message'] = $request->message;
    //     $input['created_by'] = '0';
    //     $input['created_ip_address'] = $request->ip();
    //     ContactUs::create($input);
    //     return redirect()->back()->with('success', 'Form submitted successfully. Our team will be in touch soon. Thank you!');
    // }
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required', //|digits:10
        'subject' => 'required|string',
        'captcha_form' => 'required|captcha',
    ],[
        'captcha_form.captcha' => 'Please Enter Correct Capcha',
    ]);

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


    // Create the contact information
    $input['name'] = $request->name;
    $input['email'] = $request->email;
    $input['mobile'] = $request->mobile;
    $input['subject'] = $request->subject;
    $input['message'] = $request->message;
    $input['created_by'] = '0';
    $input['created_ip_address'] = $request->ip();
    $input['browser'] = $browserName; // Add browser name to the input

    // Save the contact information
    ContactUs::create($input);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Form submitted successfully. Our team will be in touch soon. Thank you!');
}

}
