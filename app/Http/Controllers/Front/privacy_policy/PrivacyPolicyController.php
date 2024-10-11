<?php

namespace App\Http\Controllers\Front\privacy_policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $privacy_policy = CMS::where('status','active')->where('page', 'Privacy Policy')->first();
        // dd($privacy_policy);
        return view('front.privacypolicy', compact('privacy_policy'));
    }
}
