<?php

namespace App\Http\Controllers\Front\terms_and_conditions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;

class TermsAndConditionsController extends Controller
{
    public function index(){
        $terms_and_conditions = CMS::where('status','active')->where('page', 'Terms and Conditions')->first();
        // dd($terms_and_conditions);
        return view('front.termsandconditions', compact('terms_and_conditions'));
    }
}
