<?php

namespace App\Http\Controllers\Front\subscriber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
//    public function store(Request $request) {
//     $request->validate([
//         'subscriber_email' => 'required|email'
//     ]);

//     $email = $request->subscriber_email;

//     // Check if the email already exists in the database
//     $existingSubscriber = Subscriber::where('email', $email)->first();

//     if ($existingSubscriber) {
//         return redirect()->back()->with('error', 'Email already exists. Feel free to use a different email to subscribe!');
//     }

//     // Email does not exist, proceed with insertion
//     $input = [
//         'email' => $email,
//         'created_by' => '0',
//         'created_ip_address' => $request->ip()
//     ];

//     Subscriber::create($input);

//     return redirect()->back()->with('success', 'Your subscription request has been received!');
// }

public function store(Request $request)
{
    // Validate the subscriber email
    $request->validate([
        'subscriber_email' => 'required|email'
    ]);

    $email = $request->subscriber_email;

    // Check if the email already exists in the database
    $existingSubscriber = Subscriber::where('email', $email)->first();

    if ($existingSubscriber) {
        return redirect()->back()->with('error', 'Email already exists. Feel free to use a different email to subscribe!');
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


    // Email does not exist, proceed with insertion
    $input = [
        'email' => $email,
        'created_by' => '0',
        'created_ip_address' => $request->ip(),
        'browser' => $browserName // Add browser name to the input
    ];

    Subscriber::create($input);

    return redirect()->back()->with('success', 'Your subscription request has been received!');
}


}
