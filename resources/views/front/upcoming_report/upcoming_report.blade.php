@extends('front.layout.layout')
@section('title','Upcoming Reports')
@section('content')
use Illuminate\Support\Facades\Storage;
<style>
    .reports-alert{
        padding: 8px 25px;
        margin-bottom: 0;
        color: #292564;
        background-color: #ecf2ff;
        border-color: #204de21f;
        box-shadow: 4.871px 34.659px 30px 0px rgba(0, 0, 0, 0.06);
    }
</style>
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black reports-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">{{ (isset($category_details) && !empty($category_details)) ? $category_details->category_name : (isset($filter_text) ? $filter_text : 'Upcoming Reports') }}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($category_details) && !empty($category_details) ? $category_details->category_name : (isset($filter_text) ? 'Searched Reports' : 'Upcoming Reports') ; }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="light-gray-bg reports-page pt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 mb-lg-0 mb-5 wow fadeInUp text-center">
                @if(isset($category_details) && !empty($category_details))
                <div class="iq-icon-box iq-icon-box-style-5 bg-white iq-box-shadow border-bottom-box">
                    <div class="icon-box-img">
                        <img src="{{ !empty($category_details->image_path) && Storage::exists($category_details->image_path) ? url('/').Storage::url($category_details->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-fluid w-100" alt="{{ !empty($category_details->image_name) ? $category_details->image_name : '' }}">
                    </div>
                    <div class="icon-box-content text-left">
                        <h4 class="icon-box-title">{{ !empty($category_details->heading) ? $category_details->heading : '' }}</h4>
                        <div class="icon-box-desc">{!! !empty($category_details->description) ? $category_details->description : '' !!}</div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12">
                <div class="about-analytics wow fadeInLeft">
                    <h4 class="">CATEGORY</h4>
                    <div class="reports-page_list for-mobile-category-list-hide ">
                        @if(!empty($report_categories))
                            <a class="dropdown-item {{ !empty($category_details) ? '' : 'active'}}" href="{{url('/upcomingreport')}}">All</a>
                            @foreach($report_categories as $category)
                            <a class="dropdown-item {{ (!empty($category_details) && $category_details->id == $category->id) ? 'active' : '' }}" href="{{url('/upcomingreport/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id)}}">{{ !empty($category->category_name) ? $category->category_name : '' }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="dropdown for-mobile-category-list-show">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Category
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if(!empty($report_categories))
                            <a class="dropdown-item {{ !empty($category_details) ? '' : 'active'}}" href="{{url('/upcomingreport')}}">All</a>
                            @foreach($report_categories as $category)
                            <a class="dropdown-item {{ (!empty($category_details) && $category_details->id == $category->id) ? 'active' : '' }}" href="{{url('/upcomingreport/'.Str::slug(Str::replace('&','and',$category->category_name) , '-').'/'.$category->id)}}">{{ !empty($category->category_name) ? $category->category_name : '' }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-lg-9 col-md-7 col-sm-12">
                @if($report_count > 0)
                    <div class=" d-flex justify-content-between align-item-center">
                        <div class="d-flex justify-content-left">
                           {{-- {{dd($filter_text)}} --}}
                        @if(!isset($filter_text))
                            {!! $all_reports->links() !!}
                        @endif
                        </div>
                        <div class="w-5">
                            @if(isset($report_per_page) && $report_count > $report_per_page)
                            <select class="p-0" name="page_range" id="page_range">
                                @foreach(config('constant.page_range') as $page_range)
                                <option value="{{ $page_range }}" {{(!empty($report_per_page) && $report_per_page == $page_range) ? 'selected' : ''}}> {{$page_range}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    @foreach($all_reports as $report)
                    <div class="reports-lists mb-4 wow fadeInUp">
                        <div class="iq-icon-box iq-icon-box-style-5 bg-white iq-box-shadow">
                            <div class="icon-box-img">
                                {{-- <img src="{{ !empty($report->image_1_path) && Storage::exists($report->image_1_path) ? url('/').Storage::url($report->image_1_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100" alt="{{ !empty($report->image_1_name) ? $report->image_1_name : '' }}"> --}} 
                                <img src="{{ URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="w-100 report-view-img" alt="report-image">
                            </div>
                            <div class="icon-box-content">
                                <div class="reports-lists_content">
                                    <h4 class="icon-box-title">
                                        <a href="{{url('/reports/'.$report->url.'/'.$report->id)}}">{{ !empty($report->title) ? $report->title : '' }}</a>
                                    </h4>
                                    <p class="reports-desc">{!! !empty($report->description) ? substr(strip_tags($report->description), 0, 300) . '...' : '' !!}</p>
                                    <div class="report-footer">
                                        <div class="read-more-btn">
                                            <a class="fancy" href="{{url('/upcomingreports/'.$report->url.'/'.$report->id)}}">
                                                <span class="top-key"></span>
                                                <span class="text">View</span>
                                                <span class="bottom-key-1"></span>
                                                <span class="bottom-key-2"></span>
                                            </a>
                                        </div>
                                        <div class="read-more-btn">
                                            <form action="{{ url('purchase/'.$report->url.'/'.$report->id.'?license=single') }}" method="post" id="buy_now_report_form">
                                                @csrf
                                                <a type="button" class="fancy buy_now_report_btn" id="buy_now_report_btn">
                                                    <span class="top-key"></span>
                                                    <span class="text">Buy Now</span>
                                                    <span class="bottom-key-1"></span>
                                                    <span class="bottom-key-2"></span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="no-record-found-div">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="reports-alert alert alert-danger">No Record Found !</h6>
                        </div>
                    </div>
                @endif

                @if(isset($filter_text) && !empty($filter_text) && count($all_reports) == 0)
                <div class="row">
                    <div class="col-lg-7 col-md-12 mt-lg-0">
                        <div class="no-report-form">
                            <div class=" text-left iq-title-default iq-title-box-2">
                                <div class="iq-title-icon">
                                </div>
                                <h2 class="iq-title mb-4">Contact With US </h2>
                            </div>
                            <div role="form" class="wpcf7" id="wpcf7-f790-p785-o1" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form action="{{route('contact.us.query')}}" method="post" class="wpcf7-form" id="contact-form" novalidate="novalidate">
                                    @csrf
                                    <input type="hidden" name="type" value="contact">
                                    <div class=row>
                                        <div class="col-lg-6 col-md-6">
                                            <span class="wpcf7-form-control-wrap first-name"><input type="text" name="fname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="First Name" /></span>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <span class="wpcf7-form-control-wrap last-name"><input type="text" name="lname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Last Name" /></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email Address" /></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="wpcf7-form-control-wrap tel-554"><input type="tel" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" placeholder="Phone" /></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="wpcf7-form-control-wrap company"><input type="text" name="company" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Enter Company" /></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <p> <span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span>
                                            </p>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset class="MainCaptchaDiv">
                                                <span id="WrongCaptchaError" class="error"></span>
                                                <span class="text-success" id="SuccessMessage" class="error"></span>
                                                <div class="CaptchaDiv">
                                                    <div class='CaptchaWrap'>
                                                        <div id="CaptchaImageCode" class="CaptchaTxtField">
                                                            <canvas id="CapCode" class="capcode" width="100" height="60px"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="ReloadBtn" onclick='CreateCaptcha();' title="Reload Image">
                                                        <img src="{{URL::asset('front/images/new-images/reports/recycle.png')}}" alt="" class="regenerate-img" >
                                                    </div>
                                                <div class="d-flex-div">
                                                    <label for="">
                                                    <input type="text" id="UserCaptchaCode" class="CaptchaTxtField input" placeholder='Enter Captcha'>
                                                    </label>
                                                </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" value="Send" class="wpcf7-form-control wpcf7-submit form-submit-btn" onclick="CheckCaptcha();">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="no-report-right">
                            <h4>We have the sample that you are looking for. Please Enter your details, Our Sales team will get back to you Immediately</h4>
                        </div>
                    </div>
                </div>
                @endif

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
</script>
<script type="text/javascript">
    $('#page_range').change(function() {
        var limit = $(this).val();
        var link = window.location.pathname;
        var redirectLink = link + '?page_range=' + limit;
        window.location = redirectLink;
    });
</script>

<script type="text/javascript">
    $(".buy_now_report_btn").each(function() {
        $(this).click(function() {
            $(this).parent("#buy_now_report_form").submit();
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var filter_text = "{{ isset($filter_text) && !empty($filter_text) ? $filter_text : '' }}";
        $("#filter_input").val(filter_text);
    })
</script>

<!-- <script type="text/javascript">
    $("#filter_input").on('keypress',function(e) {
        if(e.which == 13) {
            e.preventDefault();
            var url = "{{ url('/searchresults/?filter=') }}" + $(this).val();
            $("#filter_input_form").attr("action", url);
            $("#filter_input_form").submit();
        }
    });
</script> -->

<script>
    var cd;

  $(function(){
    CreateCaptcha();
  });

  // Create Captcha
  function CreateCaptcha() {
    //$('#InvalidCapthcaError').hide();
    var alpha = new Array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');             
    var i;
    for (i = 0; i < 6; i++) {
      var a = alpha[Math.floor(Math.random() * alpha.length)];
      var b = alpha[Math.floor(Math.random() * alpha.length)];
      var c = alpha[Math.floor(Math.random() * alpha.length)];
      var d = alpha[Math.floor(Math.random() * alpha.length)];
      var e = alpha[Math.floor(Math.random() * alpha.length)];
      var f = alpha[Math.floor(Math.random() * alpha.length)];
    }
    cd = a + ' ' + b + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
    $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')
    
    var c = document.getElementById("CapCode"),
        ctx=c.getContext("2d"),
        x = c.width / 2,
        img = new Image();

    img.src = "front/images/white-curved.jpeg";
    img.onload = function () {
        var pattern = ctx.createPattern(img, "repeat");
        ctx.globalAlpha = "0.7";
        ctx.fillStyle = pattern;
        ctx.fillRect(0, 0, c.width, c.height);
        ctx.font="52px Roboto";
        ctx.fillStyle = 'White';
        ctx.textAlign = 'center';
        ctx.setTransform (1, -0.12, 0, 1, 0, 15);
        ctx.fillText(cd,x,55);
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
      radius = {tl: radius, tr: radius, br: radius, bl: radius};
    } else {
      var defaultRadius = {tl: 0, tr: 0, br: 0, bl: 0};
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
    }
    else {
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
  if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
    $('#WrongCaptchaError').text('Please enter code given below in a picture.').show();
    $('#UserCaptchaCode').focus();
  } else {
    if(result == false) { 
      $('#WrongCaptchaError').text('Invalid Captcha! Please try again.').show();
      CreateCaptcha();
      $('#UserCaptchaCode').focus().select();
    }
    else { 
      $('#UserCaptchaCode').val('').attr('place-holder','Enter Captcha - Case Sensitive');
      CreateCaptcha();
      $('#WrongCaptchaError').fadeOut(100);
      $('#SuccessMessage').text('Capcha Mached, Please Wait...').show();
      $('#SuccessMessage').fadeIn(100).css('display','block').delay(10000).fadeOut(250);
      $("#contact-form").submit();
    }
  }  
  }
</script>

@endsection