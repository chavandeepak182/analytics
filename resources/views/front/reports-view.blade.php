@extends('front.layout.layout')

@section('title',!empty($report_details->meta_title)?$report_details->meta_title:'')

@section('meta_description',!empty($report_details->meta_keyword)?$report_details->meta_keyword:'')

@section('meta_keywords', !empty($report_details->meta_description)?$report_details->meta_description:'')

@section('content')
<style>
    .sticky-form {
        position: static;
        width: 100%;
    }

    .for-fixed {
        width: 365px !important;
    }

    .for-static {
        width: 100% !important;
    }

    .nav-pills {
        position: static;
        top: 0;
    }

    .nav-pills.sticky {
        position: fixed;
        top: 11.5%;
        width: 772px;
        background: #fff !important;
    }

    .MainCaptchaDiv #CaptchaImageCode {
        width: 180px;
        border-radius: 6px;
    }

    .MainCaptchaDiv .CaptchaDiv {
        justify-content: unset;
        gap: 10px;
        width: 100%;
    }

    .MainCaptchaDiv #UserCaptchaCode {
        font-size: 13px;
        border-radius: 6px;
        padding: 5px 20px 5px 15px;
    }

    .MainCaptchaDiv #UserCaptchaCode::placeholder {
        color: #878787;
    }

    .MainCaptchaDiv {
        flex-direction: column;
        gap: 10px;
        padding: 10px;
    }

    .report-tab-content .row {
        display: unset;
        margin: unset;
    }

    .report-tab-content .row p {
        margin-left: 0 !important;
        margin-bottom: 10px !important;
    }

    .report-tab-content .row p.MsoNormal {
        text-indent: unset !important;
    }

    .report-tab-content h6,
    .report-tab-content table {
        margin-left: 0 !important;
    }

    .report-tab-content table tr td p.MsoNormal {
        padding: 0.75rem;
        margin-bottom: 0px !important;
        text-indent: unset !important;
        text-align: left !important;
    }

    .report-tab-content table tr:nth-child(1) td {
        background: #1b2b72 !important;
        text-align: left !important;
    }

    .report-tab-content table td {
        border: 1px solid #dddddd !important;
        padding: 0 !important;
        text-align: left !important;
    }

    .report-tab-content table td p strong {
        font-weight: 400 !important;
    }

    .report-tab-content .row .MsoListParagraph,
    .report-tab-content .row .MsoListParagraphCxSpFirst,
    .report-tab-content .row .MsoListParagraphCxSpLast,
    .report-tab-content .row .MsoListParagraphCxSpMiddle {
        text-align: left !important;
        text-indent: unset !important;
        display: flex !important;
    }

    #CheckDiscount .modal-dialog {
        margin: 2rem auto;
    }

    a {
        text-decoration: none !important;
    }
    
    
    .single-form-page {
        display: flex;
        align-items: center;
        justify-content: center; 
        margin: 20px 0 50px; 
    }
    .single-form-page input:-internal-autofill-selected {
        background: transparent !important;
    }

    .single-form-page .report_form_card_page {
        border: 1px solid #c1c1c1;
    padding: 15px 25px;
    }
    .single-form-page input:focus, .single-form-page input:hover {
        border: none !important;
    }
    .single-form-page .report_form_field {
        background: #2f34601a;
    }
    .single-form-page .report_form_field #message {
        padding: 10px 15px;
    }
    .single-form-page .report_form_field i{
        margin-top: 5px !important;
        color: #000 !important;
    }
    .single-form-page .report_form_field{
        border: 1px solid #ddd;
    }
    .single-form-page .CaptchaDiv {
        margin: 15px 0;
    }
    .single-form-page .form-submit-btn{
        margin-top: 0;
    }
    .single-form-page .form-submit-btnreport_form_input-field:focus, 
    .single-form-page .form-submit-btnreport_form_input-field:hover{
        border: unset !important;
    }
    .single-form-page .CaptchaTxtField {
        border: 1px solid #c1c1c1;
    }
    .single-form-page .report_form_input-field::placeholder, 
    .single-form-page textarea::placeholder{
        color: #000 !important;
    }
    .single-form-page .report_form_input-field, .report_form_input-field[type=text], .report_form_input-field[type=email], .report_form_input-field[type=email]
    {
        color: #fff !important;
    }
    .single-form-page .report_form_field input, .single-form-page .report_form_field textarea, .single-form-page .CaptchaTxtField {
        color: #000 !important;
    }
    #UserCaptchaCode{
        font-size: 13px !important;
    }
    .thankyou-icon {
            width: 110px;
    }
    .thank_you{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 40px 0;
    }
    a{
        text-decoration: none !important;
    }
   

</style>
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black contact-us-banner report-view-banner   ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">{{ !empty($report_details->title) ? App\Helpers\Helpers\Helper::getFirstFiveWords($report_details->title) : '' }}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active"><a href="{{url('research-reports/'.Str::slug(Str::replace('&','and',$category_details->category_name) , '-').'/'.$category_details->id)}}">{{ !empty($category_details->category_name) ? $category_details->category_name : '' }}</a></li>
                                <li class="breadcrumb-item active"><a href="">{{ !empty($report_details->title) ? App\Helpers\Helpers\Helper::getFirstFiveWords($report_details->title) : '' }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
@include('front.layout.notifications')
<section class="light-gray-bg report-view-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="report-view-heading  wow fadeInLeft">
                    <div class="report-header-div">
                        <div class="report-view_img">
                            {{-- <img src="{{ !empty($report_details->image_1_path) && Storage::exists($report_details->image_1_path) ? url('/').Storage::url($report_details->image_1_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100 report-view-img" alt="Forbes"> --}}
                            <img src="{{ URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100 report-view-img" alt="report-image">
                        </div>
                        <div class="report-view_details">
                            <h4>{{ !empty($report_details->title) ? $report_details->title : '' }}</h4>
                            <div class="report-view-details-tables">
                                <div class="detail-table-one">
                                    <ul>
                                        <li class="ul-title"> PUBLISHED ON </li>
                                        <li class="ul-sub-title">{{ !empty($report_details->published_on) ? $report_details->published_on : '' }}</li>
                                    </ul>
                                    <ul>
                                        <li class="ul-title"> NO OF PAGES </li>
                                        <li class="ul-sub-title">{{ !empty($report_details->total_pages) ? $report_details->total_pages : '' }}</li>
                                    </ul>
                                    <ul>
                                        <li class="ul-title"> CATEGORY </li>
                                        <li class="ul-sub-title">{{ !empty($category_details->category_name) ? $category_details->category_name : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="report-tabs mb-4 wow fadeInLeft">
                    <div class="iq-tabs">
                        <ul class="nav nav-pills sticky-top" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('*toc/*') || Request::is('*research-methodology/*') || Request::is('*infographics/*') || Request::is('*request-free-sample-pdf/*') ? '' : 'active show' }}" href="{{ url('reports/'.$report_details->url.'/'.$report_details->id) }}" role="tab">
                                    <h6 class="tab-title">Description</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*toc/*') ? 'active' : ''}}" href="{{ url('reports/toc/'.$report_details->url.'/'.$report_details->id) }}" role="tab">
                                    <h6 class="tab-title"> Table Of Contents </h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*research-methodology/*') ? 'active' : ''}}" href="{{ url('reports/research-methodology/'.$report_details->url.'/'.$report_details->id) }}" role="tab">
                                    <h6 class="tab-title">Research Methodology</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*infographics/*') ? 'active' : ''}}" href="{{ url('reports/infographics/'.$report_details->url.'/'.$report_details->id) }}" role="tab">
                                    <h6 class="tab-title">Infographics</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*request-free-sample-pdf/*') ? 'active' : ''}}" href="{{ url('reports/request-free-sample-pdf/'.$report_details->url.'/'.$report_details->id) }}" role="tab">
                                    <h6 class="tab-title">Request Free Sample PDF</h6>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ Request::is('*toc/*') || Request::is('*research-methodology/*') || Request::is('*infographics/*') || Request::is('*request-free-sample-pdf/*') ? '' : 'active show' }}" id="report-tab-1" role="tabpanel">
                                <div class="report-tab-content">
                                    <div class="row">
                                        {!! !empty($report_details->description) ? $report_details->description : '' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{Request::is('*toc/*') ? 'active show' : ''}}" id="report-tab-2" role="tabpanel">
                                <div class="report-tab-content">
                                    <div class="row">
                                        {!! !empty($report_details->table_of_content) ? $report_details->table_of_content : '' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{Request::is('*research-methodology/*') ? 'active show' : ''}}" id="report-tab-3" role="tabpanel">
                                <div class="report-tab-content">
                                    <div class="row">

                                        {{-- Research Methodology Page Code starts --}}

                                        <section class="bg-white research-methodology iq-ptb-60">
                                            <div class="container">
                                                <div class="research-methodology-content">
                                                    <div class="rm-content">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                                                                <div class=" text-left iq-title-default iq-title-box-2 ">
                                                                    <!-- <span class="iq-subtitle">About Us</span> -->
                                                                    <h2 class="iq-title text-capitalize">{{!empty($research->section_1_heading)?$research->section_1_heading:''}}</h2>
                                                                    {!! !empty($research->section_1_description)?$research->section_1_description:'' !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Section 1 -->
                                        <!-- Section 2 -->
                                        <section class="bg-gray research-methodology iq-ptb-60">
                                            <div class="container">
                                                <div class="research-methodology-content">
                                                    <div class="rm-content">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                                                                <div class=" text-left iq-title-default iq-title-box-2 ">
                                                                    <h2 class="iq-title text-capitalize">{{!empty($research->section_2_heading)?$research->section_2_heading:''}}</h2>
                                                                    {!! !empty($research->section_2_description)?$research->section_2_description:'' !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Section 2 -->
                                        <!-- Section 3 -->
                                        <section class="bg-white research-methodology iq-ptb-60">
                                            <div class="container">
                                                <div class="research-methodology-content">
                                                    <div class="rm-content">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                                                                <div class=" text-left iq-title-default iq-title-box-2 ">
                                                                    <!-- <span class="iq-subtitle">About Us</span> -->
                                                                    <h2 class="iq-title text-capitalize">{{!empty($research->section_3_heading)?$research->section_3_heading:''}}</h2>
                                                                    {!! !empty($research->section_3_description)?$research->section_3_description:'' !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Section 3 -->
                                        {{-- //Research Methodology Page Code Ends --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{Request::is('*infographics/*') ? 'active show' : ''}}" id="report-tab-4" role="tabpanel">
                                <div class="report-tab-content">
                                    <div class="row">
                                        @if(!empty($report_details->image_1_path))
                                        <img src="{{ Storage::exists($report_details->image_1_path) ? url('/').Storage::url($report_details->image_1_path) : '' }}" class="w-100 report-view-img mb-4" alt="{{ !empty($report_details->image_1_name) && Storage::exists($report_details->image_1_path) ? $report_details->image_1_name : '' }}">
                                        @endif
                                        @if(!empty($report_details->image_2_path))
                                        <img src="{{ Storage::exists($report_details->image_2_path) ? url('/').Storage::url($report_details->image_2_path) : '' }}" class="w-100 report-view-img mb-4" alt="{{ !empty($report_details->image_2_name) && Storage::exists($report_details->image_2_path) ? $report_details->image_2_name : '' }}">
                                        @endif
                                        @if(!empty($report_details->image_3_path))
                                        <img src="{{ Storage::exists($report_details->image_3_path) ? url('/').Storage::url($report_details->image_3_path) : '' }}" class="w-100 report-view-img mb-4" alt="{{ !empty($report_details->image_3_name) && Storage::exists($report_details->image_3_path) ? $report_details->image_3_name : '' }}">
                                        @endif
                                        {!! !empty($report_details->infographics) ? $report_details->infographics : '' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{Request::is('*request-free-sample-pdf/*') ? 'active show' : ''}}" id="report-tab-5" role="tabpanel">
                                <div class="report-tab-content">
                                    <div class="row">
                                        <div class="single-form-page {{ Session::has('success') ? 'd-none' : '' }}">
                                            <div class="report_form_card_page">
                                                
                                                <form action="{{ route('report.enquiry.store') }}" method="post" id="sample_request_form">
                                                    @csrf
                                                    <input type="hidden" id="request_type" name="request_type" value="request-free-sample-pdf">
                                                    <input type="hidden" id="report_id" name="report_id" value="{{ $report_details->id }}">
                                                    <input type="hidden" id="report_title" name="report_title" value="{{ !empty($report_details->title) ? $report_details->title : '' }}">
                                                    <div class="report_form_field">
                                                        <i aria-hidden="true" class="ion ion-ios-person"></i>
                                                        <input type="text" id="name" name="name" class="report_form_input-field" placeholder="Full Name" value="{{ old('name') }}">
                                                    </div>
                                                    @if($errors->has('name'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('name')}}</span>
                                                    @endif
                                                    <div class="report_form_field">
                                                        <i aria-hidden="true" class="ion ion-ios-email"></i>
                                                        <input type="mail" id="email" name="email" class="report_form_input-field" placeholder="Email" value="{{ old('email') }}">
                                                    </div>
                                                    @if($errors->has('email'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('email')}}</span>
                                                    @endif
                                                    <div class="report_form_field">
                                                        <i aria-hidden="true" class="ion ion-ios-telephone"></i>
                                                        <input type="text" id="mobile_number" name="mobile_number" class="report_form_input-field" placeholder="Phone No." value="{{ old('mobile_number') }}">
                                                    </div>
                                                    @if($errors->has('mobile_number'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('mobile_number')}}</span>
                                                    @endif
                                                    <div class="report_form_field">
                                                        <i aria-hidden="true" class="ion ion-briefcase"></i>
                                                        <input type="text" id="company_name" name="company_name" class="report_form_input-field" placeholder="Company" value="{{ old('company_name') }}">
                                                    </div>
                                                    @if($errors->has('company_name'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('company_name')}}</span>
                                                    @endif
                                                    <div class="report_form_field form-msg-box">
                                                        <i aria-hidden="true" class="ion ion-document-text"></i>
                                                        <span class="wpcf7-form-control-wrap your-message"><textarea id="message" name="message" cols="46" rows="12" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message" value="{{ old('message') }}"></textarea></span>
                                                    </div>
                                                    @if($errors->has('message'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('message')}}</span>
                                                    @endif

                                                    <fieldset class=" MainCaptchaDiv">
                                                        <span id="WrongCaptchaError" class="error"></span>
                                                        <span class="text-success" id="SuccessMessage" class="error"></span>
                                                        <div class="CaptchaDiv">
                                                            <div class='CaptchaWrap'>
                                                                <div id="CaptchaImageCode" class="CaptchaTxtField">
                                                                    <canvas id="CapCode" class="capcode" width="100" height="60px"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="ReloadBtn" onclick='CreateCaptcha();' title="Reload Image">
                                                                <img src="{{URL::asset('front/images/new-images/reports/recycle.png')}}" alt="" class="regenerate-img">
                                                            </div>
                                                            <div class="d-flex-div">
                                                                <label for="">
                                                                    <input type="text" id="UserCaptchaCode" class="CaptchaTxtField input" placeholder='Enter Captcha'>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <button type="button" class="form-submit-btn" onclick="CheckCaptcha();"> Send Message </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#menu" id="toggle"><span></span></a>

                    <div id="menu">
                        <ul>
                            <li><a href="{{ url('reports/'.$report_details->url.'/'.$report_details->id) }}">Description</a></li>
                            <li><a href="{{ url('reports/toc/'.$report_details->url.'/'.$report_details->id) }}"> Table Of Contents </a></li>
                            <li><a href="{{ url('reports/research-methodology/'.$report_details->url.'/'.$report_details->id) }}">Research Methodology</a></li>
                            <li><a href="{{ url('reports/infographics/'.$report_details->url.'/'.$report_details->id) }}">Infographics</a></li>
                            <li><a href="{{ url('reports/request-free-sample-pdf/'.$report_details->url.'/'.$report_details->id) }}">Request Free Sample PDF</a></li>
                        </ul>
                    </div>
                </div>

                @if(!empty($report_details->faq_status) && $report_details->faq_status == "active")
                @if(!empty($report_details->faq_question_1) || !empty($report_details->faq_question_2) || !empty($report_details->faq_question_3) || !empty($report_details->faq_question_4) || !empty($report_details->faq_question_5))
                <div class="report-view-faq">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center iq-title-box iq-title-default iq-title-box-2">
                                <div class="iq-title-icon"> </div>
                                <h2 class="iq-title">Frequently Asked Questions</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="iq-accordion  iq-accordion-semi-round iq-accordion-classic">

                                @if(!empty($report_details->faq_question_1))
                                <div class="iq-accordion-block  1">
                                    <div class="iq-accordion-title" style="">
                                        <div class="iq-icon-right"><i aria-hidden="true" class="ion ion-minus-round active"></i><i aria-hidden="true" class="ion ion-plus inactive"></i></div>
                                        <h5 class="mb-0 accordion-title">{{ $report_details->faq_question_1 }}</h5>
                                    </div>
                                    <div class="iq-accordion-details">
                                        <p class="iq-content-text">{{ $report_details->faq_answer_1 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($report_details->faq_question_2))
                                <div class="iq-accordion-block   2">
                                    <div class="iq-accordion-title">
                                        <div class="iq-icon-right"><i aria-hidden="true" class="ion ion-minus-round active"></i><i aria-hidden="true" class="ion ion-plus inactive"></i></div>
                                        <h5 class="mb-0 accordion-title">{{ $report_details->faq_question_2 }}</h5>
                                    </div>
                                    <div class="iq-accordion-details">
                                        <p class="iq-content-text">{{ $report_details->faq_answer_2 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($report_details->faq_question_3))
                                <div class="iq-accordion-block   3">
                                    <div class="iq-accordion-title">
                                        <div class="iq-icon-right"><i aria-hidden="true" class="ion ion-minus-round active"></i><i aria-hidden="true" class="ion ion-plus inactive"></i></div>
                                        <h5 class="mb-0 accordion-title">{{ $report_details->faq_question_3 }}</h5>
                                    </div>
                                    <div class="iq-accordion-details">
                                        <p class="iq-content-text">{{ $report_details->faq_answer_3 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($report_details->faq_question_4))
                                <div class="iq-accordion-block   4">
                                    <div class="iq-accordion-title">
                                        <div class="iq-icon-right"><i aria-hidden="true" class="ion ion-minus-round active"></i><i aria-hidden="true" class="ion ion-plus inactive"></i></div>
                                        <h5 class="mb-0 accordion-title">{{ $report_details->faq_question_4 }}</h5>
                                    </div>
                                    <div class="iq-accordion-details">
                                        <p class="iq-content-text">{{ $report_details->faq_answer_4 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($report_details->faq_question_5))
                                <div class="iq-accordion-block   5">
                                    <div class="iq-accordion-title">
                                        <div class="iq-icon-right"><i aria-hidden="true" class="ion ion-minus-round active"></i><i aria-hidden="true" class="ion ion-plus inactive"></i></div>
                                        <h5 class="mb-0 accordion-title">{{ $report_details->faq_question_5 }}</h5>
                                    </div>
                                    <div class="iq-accordion-details">
                                        <p class="iq-content-text">{{ $report_details->faq_answer_5 }}</p>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif

            </div>
            <div class="col-lg-4" id="scrollable-div">

            <div class="div-for-tablet sticky-form">
                    <div class="more-report-btns mb-4">
                        <div class="more-report-btns-forms">
                            <a class="button wow fadeInRight" href="{{ url('/sample-request/'.$report_details->url.'/'.$report_details->id) }}">Sample Request </a>
                            <a class="button wow fadeInRight" href="{{ url('/customization/'.$report_details->url.'/'.$report_details->id) }}"> Customized Requirement </a>
                            <a class="button wow fadeInRight" href="{{ url('/analyst/'.$report_details->url.'/'.$report_details->id) }}"> Speak to Analyst </a>
                            <a class="button wow fadeInRight" href="{{ url('/discount/'.$report_details->url.'/'.$report_details->id) }}"> Check Discount </a>
                        </div>
                    </div>

                    <div class="plans-detail mb-4 wow fadeInRight">
                        <!-- dynamic action url in js -->
                        <form action="" method="get" id="license_type_submit_form">
                            <div class="plans-detail_header">
                                <h6>CHOOSE LICENSE TYPE</h6>
                            </div>
                            <div class="plans-detail_cards form-check">

                                <div class="plans-detail_card green container-tick form-check-label" for="exampleRadios1">
                                    <input class="form-check-input" type="radio" name="license" id="exampleRadios1" value="single" checked="checked">
                                    <label for="exampleRadios1" class="form-check-label tip">Single User Access - $ {{ !empty($report_details->single_user_cost) ? $report_details->single_user_cost : '' }} </label>
                                </div>
                                <div class="plans-detail_card green form-check-label" for="exampleRadios2">
                                    <input class="form-check-input" type="radio" name="license" id="exampleRadios2" value="multi">
                                    <label for="exampleRadios2" class="form-check-label tip">Multi User Access - $ {{ !empty($report_details->multi_user_cost) ? $report_details->multi_user_cost : '' }} </label>
                                </div>
                                <div class="plans-detail_card green ">
                                    <input class="form-check-input" type="radio" name="license" id="exampleRadios3" value="enterp">
                                    <label for="exampleRadios3" class="form-check-label tip">Corporate Access - $ {{ !empty($report_details->enterprise_user_cost) ? $report_details->enterprise_user_cost : '' }} </label>
                                </div>
                            </div>
                            <div class="plans-detail_btns">
                                <button id="license_type_button" class="Btn">Buy Now</button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="recent-reports">
                    @if($related_reports->count() > 0)
                    <div class="recent-reports_heading">
                        <h6>Related Reports</h6>
                    </div>
                    @foreach($related_reports as $related_report)
                    <a href="{{ url('/reports/'.$related_report->reports->url.'/'.$related_report->reports->id) }}">
                        <div class="iq-icon-box iq-icon-box-style-2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="icon-box-img">
                                {{-- <img src="{{ !empty($related_report->image_1_path) && Storage::exists($related_report->image_1_path) ? URL('/').Storage::url($related_report->image_1_path) :  URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100 img-fluid" alt="{{ !empty($related_report->image_1_name) ? $related_report->image_1_path : '' }}"> --}}
                                <img src="{{ URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100 img-fluid" alt="report-image">
                            </div>
                            <div class="icon-box-content">
                                <h5 class="icon-box-title">{{ !empty($related_report->reports->title) ? $related_report->reports->title : '' }}</h5>
                                <p class="icon-box-desc dec-title">{{ !empty($related_report->reports->category_id) ? App\Helpers\Helpers\Helper::getCategoryNameById($related_report->reports->category_id) : '' }}</p>
                                <p class="icon-box-desc">{{ !empty($related_report->reports->published_on) ? $related_report->reports->published_on : '' }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-12">
                <!-- Pricing Start -->
                <section class="iq-pricing-host wow fadeInUp report-pricing" data-wow-duration="0.6s" id="ViewPlans">
                    <img src="images/others/shape1.png')}}" class="img-fluid shape-left" alt="QLOUD">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center iq-title-box iq-title-default iq-title-box-2">
                                    <div class="iq-title-icon">
                                    </div>
                                    <span class="iq-subtitle">Pricing</span>
                                    <h2 class="iq-title">Select a license type that suits your business needs</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="iq-price-container iq-price-table-6 text-center iq-box-shadow wow fadeInUp" data-wow-duration="0.6s">
                                    <div class="iq-price-header">
                                        <span class="iq-price-label">Single User Access</span>
                                        <h4 class="iq-price">US ${{ !empty($report_details->single_user_cost) ? $report_details->single_user_cost : '' }}<span class="iq-price-desc"></span></h4>
                                        <p class="iq-price-description">Only {{ !empty($report_details->single_user_cost) ? ucwords(App\Helpers\Helpers\Helper::rupeesToWords($report_details->single_user_cost)) : '' }} US dollar</p>
                                    </div>
                                    <div class="iq-price-footer">
                                        <div class="iq-btn-container">
                                            <a href="{{ url('/purchase/'.$report_details->url.'/'.$report_details->id.'?license=single') }}" class="iq-button iq-btn-round d-inline" id="license_type_button_1" value="single"> Buy Now </a>
                                        </div>
                                    </div>
                                    <div class="iq-price-body">
                                        <ul class="iq-price-service">
                                            <li class="inactive">
                                                <span>1 User access</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>15% Additional Free Customization</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Free Unlimited post-sale support</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>100% Service Guarantee until achievement of ROI</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="iq-price-container iq-price-table-6 text-center active iq-box-shadow wow fadeInUp" data-wow-duration="1.2s">
                                    <div class="iq-price-header">
                                        <span class="iq-price-label">Multi User Cost</span>
                                        <h4 class="iq-price">US ${{ !empty($report_details->multi_user_cost) ? $report_details->multi_user_cost : '' }}</h4>
                                        <p class="iq-price-description">Only {{ !empty($report_details->multi_user_cost) ? ucwords(App\Helpers\Helpers\Helper::rupeesToWords($report_details->multi_user_cost)) : '' }} US dollar</p>
                                    </div>
                                    <div class="iq-price-footer">
                                        <div class="iq-btn-container">
                                            <a href="{{ url('/purchase/'.$report_details->url.'/'.$report_details->id.'?license=multi') }}" class="iq-button iq-btn-round d-inline" id="license_type_button_2" value="multi"> Buy Now </a>
                                        </div>
                                    </div>
                                    <div class="iq-price-body">
                                        <ul class="iq-price-service">
                                            <li class="inactive">
                                                <span>5 Users access</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>25% Additional Free Customization</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Access Report summaries for Free</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Guaranteed service</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Dedicated Account Manager</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Discount of 20% on next purchase</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Get personalized market brief from Lead Author</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Printing of Report permitted</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Discount of 20% on next purchase</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>100% Service Guarantee until achievement of ROI</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="iq-price-container iq-price-table-6 text-center iq-box-shadow wow fadeInUp" data-wow-duration="1.8s">
                                    <div class="iq-price-header">
                                        <span class="iq-price-label">Enterprise User Cost</span>
                                        <h4 class="iq-price">US ${{ !empty($report_details->enterprise_user_cost) ? $report_details->enterprise_user_cost : '' }}</h4>
                                        <p class="iq-price-description">Only {{ !empty($report_details->enterprise_user_cost) ? ucwords(App\Helpers\Helpers\Helper::rupeesToWords($report_details->enterprise_user_cost)) : '' }} US dollar</p>
                                    </div>
                                    <div class="iq-price-footer">
                                        <div class="iq-btn-container">
                                            <a href="{{ url('/purchase/'.$report_details->url.'/'.$report_details->id.'?license=enterp') }}" class="iq-button iq-btn-round d-inline" id="license_type_button_3" value="enterp"> Buy Now </a>
                                        </div>
                                    </div>
                                    <div class="iq-price-body">
                                        <ul class="iq-price-service">
                                            <li class="inactive">
                                                <span>Unlimited User Access</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>30% Additional Free Customization</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Exclusive Previews to latest or upcoming reports</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>Discount of 30% on next purchase</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                            <li class="inactive">
                                                <span>100% Service Guarantee until achievement of ROI</span>
                                                <i aria-hidden="true" class=""></i>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Pricing End -->
            </div>
        </div>
    </div>
</section>


@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>

<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".reports_active").addClass("active");
    $(".reports-view-active").addClass("active");
</script>

<script type="text/javascript">
    $("#license_type_button").click(function() {
        var license_type = $('input[name="license"]:checked').val();
        var base_url = "{{ url('/purchase/'.$report_details->url.'/'.$report_details->id.'/?license=') }}" + license_type;
        $("#license_type_submit_form").attr("action", base_url);
        $("#license_type_submit_form").submit();
    })
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });



    $('.ipad-carousel').owlCarousel({
        loop: true,
        margin: 5,
        nav: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
</script>

<script>
    let scrollable_height = document.getElementById('scrollable-div').clientHeight;
    // $("#scrollable-div").scroll(function(e) {
    //     console.log(screenTop());
    // })
    $(window).scroll(function(e) {
        var el = $('.sticky-form');
        var isPositionFixed = (el.css('position') == 'fixed');
        el.addClass('for-fixed');
        el.removeClass('for-static');
        if ($(this).scrollTop() >= (scrollable_height - 260)) {
            el.css({
                'position': 'absolute',
                'bottom': '0px',
                'top': 'unset',
                'width': '91.5%'
            })
            el.removeClass('for-fixed');
        } else if ($(this).scrollTop() > ($(".sticky-form").height() + $(".recent-reports").height())) {
            el.css({
                'position': 'fixed',
                'bottom': 'unset',
                'top': '120px',
                'width': 'unset'
            })
            el.addClass('for-fixed')
        } else {
            el.css({
                'position': 'static',
                'bottom': 'unset',
                'width': '100%'
            })
            el.removeClass('for-fixed');
            el.addClass('for-static');
        }
        let scrollBottom = $(document).height() - $(window).height() - $(this).scrollTop();
        // console.log(scrollBottom);
    });
</script>

<script>
    if(screen.width > 768){
        var div_top = $('.nav-pills').offset().top;
        $(window).scroll(function() {
            var window_top = $(window).scrollTop();
            if (window_top > div_top && window_top < $('.report-pricing').offset().top) {
                if (!$('.nav-pills').is('.sticky')) {
                    $('.nav-pills').addClass('sticky');
                }
            } else {
                $('.nav-pills').removeClass('sticky');
            }
        });
    } else {
        $(window).scroll(function(e){
            if($(this).scrollTop() > ($("#main-header").height() + $(".main-bg").height() + $(".report-view-heading ").height() + $("#pills-tab").height())){
                $("#toggle").css({
                    'display': 'block',
                })
            } else {
                $("#toggle").css({
                    'display': 'none',
                })
            }
        })
    }
</script>

<script>
    var cd;

    $(function() {
        CreateCaptcha();
    });

    // Create Captcha
    function CreateCaptcha() {
        //$('#InvalidCapthcaError').hide();
        var alpha = new Array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');
        var i;
        for (i = 0; i < 4; i++) {
            var a = alpha[Math.floor(Math.random() * alpha.length)];
            var b = alpha[Math.floor(Math.random() * alpha.length)];
            var c = alpha[Math.floor(Math.random() * alpha.length)];
            var d = alpha[Math.floor(Math.random() * alpha.length)];
            // var e = alpha[Math.floor(Math.random() * alpha.length)];
            // var f = alpha[Math.floor(Math.random() * alpha.length)];
        }
        cd = a + ' ' + b + ' ' + c + ' ' + d;
        $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')

        var c = document.getElementById("CapCode"),
            ctx = c.getContext("2d"),
            x = c.width / 2,
            img = new Image();

        img.src = "{{asset('front/images/white-curved.jpg')}}";
        img.onload = function() {
            var pattern = ctx.createPattern(img, "repeat");
            ctx.globalAlpha = "0.7";
            ctx.fillStyle = pattern;
            ctx.fillRect(0, 0, c.width, c.height);
            ctx.font = "52px Roboto";
            ctx.fillStyle = 'lightgreen';
            ctx.textAlign = 'center';
            ctx.setTransform(1, -0.12, 0, 1, 0, 15);
            ctx.fillText(cd, x, 55);
        };

    }

    //
    function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
        if (typeof stroke === 'undefined') {
            stroke = true;
        }
        if (typeof radius === 'undefined') {
            radius = 5;
        }
        if (typeof radius === 'number') {
            radius = {
                tl: radius,
                tr: radius,
                br: radius,
                bl: radius
            };
        } else {
            var defaultRadius = {
                tl: 0,
                tr: 0,
                br: 0,
                bl: 0
            };
            for (var side in defaultRadius) {
                radius[side] = radius[side] || defaultRadius[side];
            }
        }
        ctx.beginPath();
        ctx.moveTo(x + radius.tl, y);
        ctx.lineTo(x + width - radius.tr, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius.tr);
        ctx.lineTo(x + width, y + height - radius.br);
        ctx.quadraticCurveTo(x + width, y + height, x + width - radius.br, y + height);
        ctx.lineTo(x + radius.bl, y + height);
        ctx.quadraticCurveTo(x, y + height, x, y + height - radius.bl);
        ctx.lineTo(x, y + radius.tl);
        ctx.quadraticCurveTo(x, y, x + radius.tl, y);
        ctx.closePath();
        if (fill) {
            ctx.fill();
        }
        if (stroke) {
            ctx.stroke();
        }

    }

    // Validate Captcha
    function ValidateCaptcha() {
        var string1 = removeSpaces(cd);
        var string2 = removeSpaces($('#UserCaptchaCode').val());
        if (string1 == string2) {
            return true;
        } else {
            return false;
        }
    }

    // Remove Spaces
    function removeSpaces(string) {
        return string.split(' ').join('');
    }

    // Check Captcha
    function CheckCaptcha() {
        var result = ValidateCaptcha();
        if ($("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
            $('#WrongCaptchaError').text('Please enter code given below in a picture.').show();
            $('#UserCaptchaCode').focus();
        } else {
            // console.log(result);
            if (result == false) {
                $('#WrongCaptchaError').text('Invalid Captcha! Please try again.').show();
                CreateCaptcha();
                $('#UserCaptchaCode').focus().select();
            } else {
                $('#UserCaptchaCode').val('').attr('place-holder', 'Enter Captcha - Case Sensitive');
                CreateCaptcha();
                $('#WrongCaptchaError').fadeOut(100);
                $('#SuccessMessage').text('Capcha Mached, Please Wait...').show();
                $('#SuccessMessage').fadeIn(100).css('display','block').delay(10000).fadeOut(250);
                $("#sample_request_form").submit();
            }
        }
    }
</script>

<!-- <script>
    var div_top = $('.nav-pills').offset().top;
    $(window).scroll(function() {
        var window_top = $(window).scrollTop();
        if (window_top > div_top && window_top < $('.report-pricing').offset().top) {
            if (!$('.nav-pills').is('.sticky')) {
                $('.nav-pills').addClass('sticky');
            }
        } else {
            $('.nav-pills').removeClass('sticky');
        }
    });
</script> -->

<!-- toggle -->
<script>
    var theToggle = document.getElementById('toggle');

    // hasClass
    function hasClass(elem, className) {
        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
    }
    // addClass
    function addClass(elem, className) {
        if (!hasClass(elem, className)) {
            elem.className += ' ' + className;
        }
    }
    // removeClass
    function removeClass(elem, className) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
        if (hasClass(elem, className)) {
            while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
                newClass = newClass.replace(' ' + className + ' ', ' ');
            }
            elem.className = newClass.replace(/^\s+|\s+$/g, '');
        }
    }
    // toggleClass
    function toggleClass(elem, className) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
        if (hasClass(elem, className)) {
            while (newClass.indexOf(" " + className + " ") >= 0 ) {
                newClass = newClass.replace( " " + className + " " , " " );
            }
            elem.className = newClass.replace(/^\s+|\s+$/g, '');
        } else {
            elem.className += ' ' + className;
        }
    }

    theToggle.onclick = function() {
    toggleClass(this, 'on');
    return false;
    }
</script>
<!-- toggle -->

@endsection