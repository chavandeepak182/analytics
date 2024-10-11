<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Career_application;
use App\Models\ContactUs;
use App\Models\Get_a_quote;
use App\Models\Subscriber;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Get_a_quote = Get_a_quote::where('status', '!=', 'delete')->count();
        $ContactUs = ContactUs::where('status', 'active')->count();
        $Career_application = Career_application::where('status', 'active')->count();
        $Subscriber = Subscriber::where('status', 'active')->count();
        return view('admin/dashboard', compact('Get_a_quote', 'ContactUs', 'Career_application', 'Subscriber'));
    }


}
