<?php

namespace App\Http\Controllers\Front\career;

use App\Http\Controllers\Controller;
use App\Models\Career_application;
use Illuminate\Http\Request;
use App\Models\Career_cms;
use App\Models\Career_list;

class CareerController extends Controller
{
    public function index(){
        $career_cms = Career_cms::where('status', 'active')->first();
        $career_list = Career_list::where('status', 'active')->orderByDesc('id')->get();
        return view('front.careers', compact('career_cms', 'career_list'));
    }

    public function career_details($slug_url){
        $career_cms = Career_cms::where('status', 'active')->first();
        $career_details = Career_list::where('status', 'active')->where('slug_url', $slug_url)->first();
        if(!empty($career_details)){
            return view('front.career-view', compact('career_cms', 'career_details'));
        }
        abort(404, 'Not found');
    }
   
    
}
