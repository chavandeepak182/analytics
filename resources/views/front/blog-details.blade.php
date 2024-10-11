@extends('front.layout.layout')

@section('title',!empty($blog_details->meta_title)?$blog_details->meta_title:'')

@section('meta_description',!empty($blog_details->meta_keyword)?$blog_details->meta_keyword:'')

@section('meta_keywords', !empty($blog_details->meta_description)?$blog_details->meta_description:'')
@section('content')

<style >
    .sticky-form {
        position: static;
    }

    .sticky-form.fixedElement {
        width: 370px;
    }
    .MainCaptchaDiv #CaptchaImageCode {
        /* width: 165px !important; */
    height: 40px !important;
}
    .MainCaptchaDiv #CapCode, .MainCaptchaDiv #UserCaptchaCode {
    height: 40px !important;
}
    .MainCaptchaDiv #UserCaptchaCode {
    margin-bottom: 0 !important;
    border: 1px solid #eeeeee !important;
    color: #59597e !important;
    padding: 5px 20px 5px 20px !important;
    font-size: 13px;
}
.MainCaptchaDiv {
    margin-bottom: 5px;
    text-align: center;
}
</style>

@include('front.layout.notifications')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black blog-details-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            {{-- <h2 class="title">{{!empty($blog_details->title)?$blog_details->title:''}}</h2> --}}
                            <h2 class="title">Blogs</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item"><a href="{{url('blog')}}">Blogs </a></li>
                                <li class="breadcrumb-item active">{{!empty($blog_details->title) ? App\Helpers\Helpers\Helper::getFirstFiveWords($blog_details->title) : ''}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Blog Start -->
<div class="iq-blog-section overview-block-ptb blog-details" style="padding: 10px 0;">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 p-3">
                <h3 class="icon-box-title" style="text-align: center;">{{!empty($blog_details->title)?$blog_details->title:''}}</h3>
                <hr class="mt-3">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 mt-lg-0 mt-5">
                <div class="iq-blog-box">
                    {{-- <div class="iq-blog-image clearfix">
                         <img src="{{!empty($blog_details->image_path) && (Storage::exists($blog_details->image_path)) ? url('/').Storage::url($blog_details->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="qloud" />
                    </div> --}}
                    <div class="iq-blog-detail">
                       {!!  !empty($blog_details->description)?$blog_details->description:'' !!}
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 mt-lg-0 mt-5">
                <div class="recent-blogs">
                    <div class="recent-blogs_heading">
                        <h6>Recent Blogs</h6>
                    </div>
                    @if(!empty($recentBlogs))
                    @foreach ($recentBlogs as $recentBlog)
                      <a href="{{url('blog/'.(!empty($recentBlog->slug_url)?$recentBlog->slug_url:'#'))}}">
                        <div class="iq-icon-box iq-icon-box-style-2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            {{-- <div class="icon-box-img">
                                <img src="{{!empty($recentBlog->image_path) && Storage::exists($recentBlog->image_path) ? url('/').Storage::url($recentBlog->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="w-100 img-fluid" alt="qloud">
                            </div> --}}
                            <div class="icon-box-content">

                                <h5 class="icon-box-title">{{!empty($recentBlog->title)?$recentBlog->title:''}}</h5>
                                @php
                                    $dateString = !empty($recentBlog->published_on)?$recentBlog->published_on:'';
                                    $timestamp = strtotime($dateString);
                                    $formattedDate = date('j F Y', $timestamp);
                                @endphp
                                <p class="icon-box-desc">{{$formattedDate}}</p>
                            </div>
                        </div>
                    </a> 
                 @endforeach
                 @endif

                </div>
                @if(!empty($report))
                <div class="right-side-buttons">
                    <div class="read-more-btn">
                        <a class="fancy" href="{{ url('/reports'.'/'.$report->url.'/'.$report->id) }}">
                            <span class="top-key"></span>
                            <span class="text">View</span>
                            <span class="bottom-key-1"></span>
                            <span class="bottom-key-2"></span>
                        </a>
                    </div>
                    <div class="read-more-btn">
                        <a class="fancy" href="{{url('/purchase'.'/'.$report->url.'/'.$report->id.'?license=single')}}">
                            <span class="top-key"></span>
                            <span class="text">Buy Now</span>
                            <span class="bottom-key-1"></span>
                            <span class="bottom-key-2"></span>
                        </a>
                    </div>
                </div>
                @endif
                <div class="sticky-form fixedElement  wow fadeInRight">
                    <div class="sticky-form_card">
                        <span class="sticky-form_title">Need Help?</span>
                        <form method="post" action="{{url('/reports/enquiry')}}" id="report-form" class="blog-detail-form">
                            @csrf
                            <input type="hidden" id="request_type" name="request_type" value="blog">
                            <input type="hidden" id="report_id" name="report_id" value="{{ !empty($report) ? $report->id : '' }}">
                            <input type="hidden" id="report_title" name="report_title" value="{{!empty($blog_details->title)?$blog_details->title:''}}">
                            <div class="row">
                                <div class="form-heading col-lg-12 form-secnd-heading">
                                    <span>Please fill your details.</span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                                    <input type="text" name="name" placeholder="Name" required />
                                    @if($errors->has('name'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('name')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                                    <input type="email" name="email" placeholder="Email Address" required />
                                    @if($errors->has('email'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('email')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                                    <input type="text" name="mobile_number" placeholder="Phone" required />
                                    @if($errors->has('mobile_number'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('mobile_number')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 ">
                                    <textarea name="message" placeholder="Write a Message" required></textarea>
                                    @if($errors->has('message'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('message')}}</span>
                                    @endif
                                </div>

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

                                <div class="form-group col-lg-12">
                                    <button type="submit" class="theme-btn btn-style-one form-submit-btn" id="send_msg" type="button" name="reach_form_submit">
                                        <span class="btn-title">Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- #row -->
    </div>
</div>

@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".media_active").addClass("active");
    $(".blogs-active").addClass("active");
</script>

<script>
//     var cd;

//   $(function(){
//     CreateCaptcha();
//   });

//   // Create Captcha
//   function CreateCaptcha() {
//     //$('#InvalidCapthcaError').hide();
//     var alpha = new Array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');
                      
//     var i;
//     for (i = 0; i < 4; i++) {
//       var a = alpha[Math.floor(Math.random() * alpha.length)];
//       var b = alpha[Math.floor(Math.random() * alpha.length)];
//       var c = alpha[Math.floor(Math.random() * alpha.length)];
//       var d = alpha[Math.floor(Math.random() * alpha.length)];
//     //   var e = alpha[Math.floor(Math.random() * alpha.length)];
//     //   var f = alpha[Math.floor(Math.random() * alpha.length)];
//     }
//     cd = a + ' ' + b + ' ' + c + ' ' + d;
//     $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')
    
//     var c = document.getElementById("CapCode"),
//         ctx=c.getContext("2d"),
//         x = c.width / 2,
//         img = new Image();

//     img.src = "{{asset('front/images/white-curved.jpg')}}";
//     img.onload = function () {
//         var pattern = ctx.createPattern(img, "repeat");
//         ctx.globalAlpha = "0.7";
//         ctx.fillStyle = pattern;
//         ctx.fillRect(0, 0, c.width, c.height);
//         ctx.font="52px Roboto";
//         ctx.fillStyle = 'White';
//         ctx.textAlign = 'center';
//         ctx.setTransform (1, -0.12, 0, 1, 0, 15);
//         ctx.fillText(cd,x,55);
//     };
    
//   }

  //
//   function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
//     if (typeof stroke === 'undefined') {
//       stroke = true;
//     }
//     if (typeof radius === 'undefined') {
//       radius = 5;
//     }
//     if (typeof radius === 'number') {
//       radius = {tl: radius, tr: radius, br: radius, bl: radius};
//     } else {
//       var defaultRadius = {tl: 0, tr: 0, br: 0, bl: 0};
//       for (var side in defaultRadius) {
//         radius[side] = radius[side] || defaultRadius[side];
//       }
//     }
//     ctx.beginPath();
//     ctx.moveTo(x + radius.tl, y);
//     ctx.lineTo(x + width - radius.tr, y);
//     ctx.quadraticCurveTo(x + width, y, x + width, y + radius.tr);
//     ctx.lineTo(x + width, y + height - radius.br);
//     ctx.quadraticCurveTo(x + width, y + height, x + width - radius.br, y + height);
//     ctx.lineTo(x + radius.bl, y + height);
//     ctx.quadraticCurveTo(x, y + height, x, y + height - radius.bl);
//     ctx.lineTo(x, y + radius.tl);
//     ctx.quadraticCurveTo(x, y, x + radius.tl, y);
//     ctx.closePath();
//     if (fill) {
//       ctx.fill();
//     }
//     if (stroke) {
//       ctx.stroke();
//     }

//   }

//   // Validate Captcha
//   function ValidateCaptcha() {
//     var string1 = removeSpaces(cd);
//     var string2 = removeSpaces($('#UserCaptchaCode').val());
//     if (string1 == string2) {
//       return true;
//     }
//     else {
//       return false;
//     }
//   }

//   // Remove Spaces
//   function removeSpaces(string) {
//     return string.split(' ').join('');
//   }

//   // Check Captcha
//   function CheckCaptcha() {
//   var result = ValidateCaptcha();
//   if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
//     $('#WrongCaptchaError').text('Please enter code given below in a picture.').show();
//     $('#UserCaptchaCode').focus();
//   } else {
//     if(result == false) { 
//       $('#WrongCaptchaError').text('Invalid Captcha! Please try again.').show();
//       CreateCaptcha();
//       $('#UserCaptchaCode').focus().select();
//     }
//     else { 
//       $('#UserCaptchaCode').val('').attr('place-holder','Enter Captcha - Case Sensitive');
//       CreateCaptcha();
//       $('#WrongCaptchaError').fadeOut(100);
//       $('#SuccessMessage').text('Capcha Mached, Please Wait...').show();
//       $('#SuccessMessage').fadeIn(100).css('display','block').delay(10000).fadeOut(250);
//       $("#report-form").submit();
//     }
//   }  
//   }
// </script>

<script>
    $(window).scroll(function(e) {
        var el = $('.sticky-form');
        var isPositionFixed = (el.css('position') == 'fixed');
        if ($(this).scrollTop() > 830 && $(document).height() - $(window).height() - $(this).scrollTop() > 900) {
            el.css({
                'position': 'fixed',
                'top': '131px',
                'bottom': 'unset'
            });
            // console.log("frst");
        } else if ($(this).scrollTop() < 1200 && isPositionFixed && $(document).height() - $(window).height() - $(this).scrollTop() > 950) {
            el.css({
                'position': 'static',
                'top': 'unset',
                'bottom': 'unset'
            });
            // console.log("secnd");
        } else if ($(document).height() - $(window).height() - $(this).scrollTop() < 400 && isPositionFixed) {
            el.css({
                'position': 'absolute',
                'bottom': '10px',
                'top': 'unset',
            });
            // console.log("third");
        }
        let scrollBottom = $(document).height() - $(window).height() - $(this).scrollTop();
        // console.log(scrollBottom);
    });
</script>

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