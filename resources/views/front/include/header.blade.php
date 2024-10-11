<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="google-site-verification" content="4hnBmrwVOVyAw3SFA6V-Q4hNVMkyK6HDAvfrrCiWbbI" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <title>Analyst Market Reasearch</title> -->
    <!-- Favicon -->
    @php
        $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('favicon_image_path','favicon_image_name')->first();
    @endphp
    <link rel="shortcut icon" href="{{ !empty($logo_image->favicon_image_path) && Storage::exists($logo_image->favicon_image_path) ? url('/').Storage::url($logo_image->favicon_image_path) : asset('front/images/we-favicon.png') }}" />
    <!-- <link rel="shortcut icon" href="{{ asset('front/images/we-favicon.png') }}" /> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/revslider/css/rs6.css')}}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('front/css/typography.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
    <!-- Style CSS -->
    <link rel='stylesheet' href="{{asset('front/css/qloud-style.css')}}" />

    <link rel="stylesheet" href="{{asset('front/css/custom.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/custom-responsive.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/swiper-bundle.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/js/jquery.toast.min.css') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-557MBNEECK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-557MBNEECK');
    </script>

</head>
<style>
    .owl-carousel .owl-item img {
        width: 100% !important;
        height: 300px;
    }

    .iq-client.iq-has-grascale li img,
    .iq-client.iq-has-grascale .item img {
        object-fit: contain;
    }
</style>

<?php

use Illuminate\Support\Str;
use App\Models\ReportCategory;

$reportCategories = ReportCategory::where('status', '=', 'active')->get();
?>

<body>
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <!-- loading End -->

    <!-- Header -->
    <header id="main-header" class="header-main header2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav id="navbar" class="navbar navbar-expand-lg navbar-light nav-page">
                        <a class="navbar-brand" href="{{URL::asset('/')}}">
                            @php
                                $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('logo_image_path','logo_image_name')->first();
                            @endphp
                            <img src="{{ !empty($logo_image->logo_image_path) && Storage::exists($logo_image->logo_image_path) ? url('/').Storage::url($logo_image->logo_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" alt="{{ !empty($logo_image->logo_image_name) ? $logo_image->logo_image_name : 'Logo Image' }}" style="max-width: 160px; max-height: 160px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu-btn d-inline-block" id="menu-btn">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </span>
                            <span class="ion-navicon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                                <li class="nav-item dropdown">
                                    <a class="nav-link active home_active" href="{{url('/')}}">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle about_active" href="" id="navbarDropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        About Us
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                        <a class="dropdown-item aboutus-active" href="{{url('aboutus/')}}">Who are We</a>
                                        <a class="dropdown-item research_methodology_active" href="{{url('research-methodology')}}">Research Methodology</a>
                                        <a class="dropdown-item why-choose-us-active" href="{{url('aboutus#why_choose_us')}}">Why Choose US</a>
                                        <a class="dropdown-item careers-active" href="{{url('careers')}}">Careers</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle services_active" href="{{url('services')}}" id="navbarDropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Services
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                         <a class="dropdown-item we-market-knowledge-active" href="{{url('services/subscription')}}">Market Research Studies</a>
                                         <a class="dropdown-item consulting_active" href="{{url('services/consulting')}}">Consulting</a>
                                     <a class="dropdown-item custom-research-active" href="{{url('services/custom-market-research')}}">Custom Research Services</a>
                                         <a class="dropdown-item we-market-client-support-active" href="{{url('services/we-market-client-support')}}">We Market Client Support</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown for-mobile-reports">
                                    <a class="nav-link dropdown-toggle reports_active" href="javscript:void(0);" id="navbarDropdown-2">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                        @if(!empty($reportCategories))
                                        <a class="dropdown-item reports-view-active" href="{{ url('/research-reports/all') }}">All Reports</a>
                                        @foreach($reportCategories as $category)
                                        <a class="dropdown-item reports-view-active" href="{{url('/research-reports/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id)}}">{{ !empty($category->category_name) ? $category->category_name : '' }}</a>
                                        @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li class="nav-item dropdown for-desktop-reports">
                                    <a class="nav-link dropdown-toggle reports_active" href="{{ url('/research-reports/all') }}" id="navbarDropdown-2">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                        @if(!empty($reportCategories))
                                        @foreach($reportCategories as $category)
                                        <a class="dropdown-item " href="{{url('/research-reports/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id)}}">{{ !empty($category->category_name) ? $category->category_name : '' }}</a>
                                        @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle subscription_active" href="#" id="navbarDropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Subscription
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                        <a class="dropdown-item we-market-knowledge-active" href="{{url('services/subscription')}}">We Market Knowledge Base</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle media_active" href="javascript:void(0)" id="navbarDropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Media
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                                        <a class="dropdown-item blogs-active" href="{{url('blog')}}">Blogs</a>
                                        <a class="dropdown-item infographics-active" href="{{url('infographics')}}">Infographics</a>
                                        <a class="dropdown-item press-release-active" href="{{url('press-release')}}">Press Release</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link contact_active" href="{{url('contactus')}}">
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                </li>
                            </ul>
                        </div>

                        <div class="top-nav text-right">
                            <div class="searchBox search-for-desktop">
                                <form action="{{ url('/searchresults') }}" method="get" id="filter_input_form">
                                    <div class="for-mobile-search-icon">
                                        <i class="fa fa-search" onclick="mySearchFunction()"></i>
                                    </div>
                                    <div class="nav-search-box-div" id="mySearchDiv">
                                        <input class="searchInput" type="text" name="filter" placeholder="search.." value="{{ !empty($filter_text) ? $filter_text : old('filter') }}" placeholder="Search something">
                                        <button class="searchButton" href="#"> <i class="fa fa-search"></i> </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
        function mySearchFunction() {
            if ($('#mySearchDiv').css('display') == 'none') {
                $("#mySearchDiv").css('display', 'block');
            } else {
                $("#mySearchDiv").css('display', 'none');
            }
        }
    </script>