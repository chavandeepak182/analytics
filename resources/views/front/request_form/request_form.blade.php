@extends('front.layout.layout')
@section('title', !empty($request_type) ? $request_type : '')
@section('content')
<style>
    .icon-box-content h6 {
        font-size: 20px;
    }
    .para-type{
        font-size: 12px;
        margin: 10px 0 0;
        color: #0d1e67;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .para-type span{
        color: #dc354585;
    }

    .icon-box-content {
        width: 100% !important;
    }
    .icon-box-content h6 {
        margin-bottom: 10px;
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
                            <h2 class="title">{{ $request_type }}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item"><a href="{{url('research-reports/'.Str::slug(Str::replace('&','and',$category_details->category_name) , '-').'/'.$category_details->id)}}">{{ !empty($category_details->category_name) ? $category_details->category_name : '' }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/reports/'.$report_details->url.'/'.$report_details->id) }}">{{ !empty($report_details->title) ? App\Helpers\Helpers\Helper::getFirstFiveWords($report_details->title) : '' }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Sample Request Form -->
@include('front.layout.notifications')
<div class="container">
    <div class="iq-icon-box iq-icon-box-style-5 mt-5 bg-white iq-box-shadow wow fadeInUp" data-wow-duration="0.7s" style="visibility: visible; animation-duration: 0.7s; animation-name: fadeInUp;">
        <div class="icon-box-content">
            <h6>Report Title:</h6>
            <a href="{{ url('/reports/'.$report_details->url.'/'.$report_details->id) }}">{{ !empty($report_details->title) ? $report_details->title : '' }}</a>
            <p class="para-type">Report Format: <span>PPT, PDF, WORD, EXCEL</span></p>
        </div>
    </div>

    <div class="single-form-page {{ Session::has('success') ? 'd-none' : '' }}">
        <div class="report_form_card_page">
            
            <form action="{{ route('report.enquiry.store') }}" method="post" id="sample_request_form">
                <div class="modal-discount-div {{ ($request_slug == 'discount') ? '' : 'd-none' }}" id="modal_discount_form">
                    <h6 class="modal-discount-div-title">We found you Lucky you Availed 10% Discount !</h6>
                </div>
                @csrf
                <input type="hidden" id="request_type" name="request_type" value="{{ $request_slug }}">
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

                <div class="col-lg-12">
                    <fieldset class="MainCaptchaDiv">
                        @if($errors->has('captcha'))
                            <span class="text-danger"><b>*</b> {{$errors->first('captcha')}}</span>
                        @endif
                        <span class="text-success" id="SuccessMessage" class="error"></span>
                        <div class="CaptchaDiv">
                            <div class='CaptchaWrap'>
                                <div id="CaptchaImageCode" class="captcha CaptchaTxtField">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                            </div>
                            <div id="reload" class="ReloadBtn" title="Reload Image">
                                <img src="{{URL::asset('front/images/new-images/reports/recycle.png')}}" alt="" class="regenerate-img" >
                            </div>
                            <div class="d-flex-div">
                                <label for="">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <button type="submit" class="form-submit-btn"> Send Message </button>

            </form>
        </div>
    </div>
    <div class="thank_you  {{ Session::has('success') ? '' : 'd-none' }}">
        {{--<img src="{{URL::asset('front/images/new-images/reports/thankyou.png')}}" alt="" class="thankyou-icon">--}}
        <h1>Thank You !</h1>
        <h3>Your Request Reached To Us</h3>
        <a class="mt-4" href="{{ url('/reports/'.$report_details->url.'/'.$report_details->id) }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
</div>
            
<!-- Sample Request Form -->
@endsection


@section('script')
<script>
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{ url("/reload-captcha") }}',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection