<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCard;
use Illuminate\Http\Request;
use App\Models\StratergicBanner;
use App\Models\StratergicAboutus;
use App\Models\StratergicCard;
use App\Models\StratergicCardthree;
use App\Models\StratergicsmallBanner;
use App\Models\CustomBanner;
use App\Models\CustomAboutUs;
use App\Models\CustomCard;
use App\Models\CustomCardFour;
use App\Models\CustomCardThree;
use App\Models\CustomSmallBanner;

use App\Models\DigitalBanner;
use App\Models\DigitalAbout;
use App\Models\DigitalCard;
use App\Models\DigitalCardThree;
use App\Models\DigitalSmallBanner;

use App\Models\AppBanner;
use App\Models\Appcard;
use App\Models\AppcardThree;
use App\Models\Appcardtwo;
use App\Models\AppSmallBanner;
class ServicesFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
        $banner=StratergicBanner::where('status','active')->first();
        $about =StratergicAboutus::where('status','active')->first();
        $smallbanner =StratergicsmallBanner::where('status','=','active')->first();
        $card=StratergicCard::where('status','=','active')->get ();
        $card3=StratergicCardthree::where('status','=','active')->get();
       
        return view('front/strategic-consulting',compact('banner','about','smallbanner','card','card3'));
    }

    public function Digital_index()
    {
        //
        $banner=DigitalBanner::first();
        $about =DigitalAbout::where('status','active')->first();
        $smallbanner =DigitalSmallBanner::where('status','=','active')->first();
        $card=DigitalCard::where('status','=','active')->get ();
        $card3=DigitalCardThree::where('status','=','active')->get();
        return view('front/digital-marketing',compact('banner','about','smallbanner','card','card3'));
    }
     

    public function App_index()
    {
        //
        $banner=AppBanner::first();
        $smallbanner= AppSmallBanner::where('status','=','active')->first();
        $card=Appcard::where('status','=','active')->get ();
        $card2=Appcardtwo::where('status','=','active')->get();
        // $card3=AppcardThree::where('status','=','active')->get();
        $card3= PortfolioCard::where('status', '=', 'active')
        ->where('portfolio_card_category', '=', 'app_design')
        ->get();
        return view('front/mobile-app-development',compact('banner','smallbanner','card','card3','card2'));
    }

    public function Custom_index()
    {
        //
        $banner=CustomBanner::first();
        $about =CustomAboutUs::where('status','active')->first();
        $smallbanner =CustomSmallBanner::where('status','=','active')->first();
        $card=CustomCard::where('status','=','active')->get ();
        $card3=CustomCardThree::where('status','=','active')->get();
        $card4=CustomCardFour::where('status','=','active')->get();

        return view('front/custom-development',compact('banner','about','smallbanner','card','card3','card4'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
