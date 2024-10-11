@extends('front.layout.layout')

@section('title',!empty($press_release->meta_title)?$press_release->meta_title:'')

@section('meta_description',!empty($press_release->meta_keyword)?$press_release->meta_keyword:'')

@section('meta_keywords', !empty($press_release->meta_description)?$press_release->meta_description:'')

@section('content')

<style>
    .sticky-form {
        position: static;
    }

    .sticky-form.fixedElement {
        width: 370px !important;
    }
    .press-release-form .CaptchaWrap { 
    position: relative; 
}
.press-release-form .CaptchaTxtField { 
  border-radius: 5px;
  border: 1px solid #ccc; 
  display: block;  
  box-sizing: border-box;
}

.d-flex-div{
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.press-release-form #UserCaptchaCode { 
  padding: 15px 10px; 
  outline: none; 
  font-size: 13px; 
  font-weight: normal; 
  width: 100%;
}
.press-release-form #CaptchaImageCode { 
  text-align:center;
  padding: 0px 0;
  overflow: hidden;
  height: 35px;
}

.press-release-form .capcode { 
  display: block; 
  width: 162px;
  height: 35px;
  border-radius: 0px !important;
}
.press-release-form .CaptchaDiv{ 
  display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.press-release-form .ReloadBtn { 
  background-color : transparent;
  cursor: pointer;
}
.press-release-form .ReloadBtn img { 
  width: 30px;
}
.press-release-form .btnSubmit {
  margin-top: 15px;
  border: 0px;
  padding: 10px 20px; 
  border-radius: 5px;
  font-size: 18px;
  background-color: #1285c4;
  color: #fff;
  cursor: pointer;
}

.press-release-form .error { 
  color: red; 
  font-size: 12px; 
  display: none; 
}
.press-release-form .success {
  color: green;
  font-size: 18px;
  margin-bottom: 15px;
  display: none;
}
</style>
<!-- Breadcrumb Start -->
@include('front.layout.notifications')
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black press-release-view-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Press Release</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active"><a href="{{url('/press-release')}}">Press Release</a></li>
                                <li class="breadcrumb-item active"> {{!empty($press_release->title) ? App\Helpers\Helpers\Helper::getFirstFiveWords($press_release->title) : ''}}</li>
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
<div class="iq-blog-section overview-block-ptb press-view-details" style="padding: 10px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="press-view-content_img">
                    <img src="{{ !empty($press_release->image_path) ? url('/').Storage::url($press_release->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-fluid" alt="qloud" />
                </div> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4 p-3">
                    <h3 class="icon-box-title" style="text-align: center;">{{!empty($press_release->title)?$press_release->title:''}}</h3>
                    <hr class="mt-3">
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 mt-lg-0 mt-5">
                <div class="content-card">
                    <div class="press-released-heading">
                    </div>
                    <div class="press-view-content">
                        {!! !empty($press_release->description)?$press_release->description:''!!}
                    </div>

                </div>
            </div>


            {{--<div class="col-lg-4 col-sm-12 mt-lg-0 mt-5">
                <div class="sticky-form fixedElement  wow fadeInRight">
                    <div class="sticky-form_card">
                        <span class="sticky-form_title">Need Help?</span>
                        
                        <form method="post" action="{{route('contact.us.query')}}" id="press-release-form" class="blog-detail-form press-release-form">
                        @csrf    
                        <div class="row">
                                <div class="form-heading col-lg-12 form-secnd-heading">
                                    <span>Please fill your details.</span>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                                    <input type="text" name="name" placeholder="Your name" required />
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
                                    <input type="text" name="phone" placeholder="Phone" required />
                                    @if($errors->has('phone'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('phone')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                                    <input type="text" name="company" placeholder="Company" required />
                                    @if($errors->has('company'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('company')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 ">
                                    <textarea name="message" placeholder="Write a Message" required></textarea>
                                    @if($errors->has('message'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('message')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-12 ">
                                    <fieldset>
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
                                            <input type="text" id="UserCaptchaCode" class="CaptchaTxtField input" placeholder="Enter Captcha">
                                          </label>
                                        </div>
                                      </div>
                                    </fieldset>
                                </div>

                                <div class="form-group col-lg-12">
                                    <button class="theme-btn btn-style-one form-submit-btn" id="send_msg" type="button" onclick="CheckCaptcha()" name="reach_form_submit">
                                        <span class="btn-title">Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>--}}
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
    $(".press-release-active").addClass("active");
</script>

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
        ctx=c.getContext("2d"),
        x = c.width / 2,
        img = new Image();

    img.src = "{{asset('front/images/white-curved.jpg')}}";
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
        $("#press-release-form").submit()
        }
    }  
    } 
</script>

<script>
    window.oncontextmenu = () => {
        var captcha = grecaptcha.getResponse();
        document.getElementById("code").innerHTML = captcha;
    };
</script>

<script>
    $(window).scroll(function(e) {
        var el = $('.sticky-form');
        var isPositionFixed = (el.css('position') == 'fixed');
        if ($(this).scrollTop() > 750 && $(document).height() - $(window).height() - $(this).scrollTop() > 720) {
            el.css({
                'position': 'fixed',
                'top': '131px',
                'bottom': 'unset'
            });
            // console.log("frst");
        } else if ($(this).scrollTop() < 1200 && isPositionFixed && $(document).height() - $(window).height() - $(this).scrollTop() > 450) {
            el.css({
                'position': 'static',
                'top': 'unset',
                'bottom': 'unset'
            });
            // console.log("secnd");
        } else if ($(document).height() - $(window).height() - $(this).scrollTop() < 1600 && isPositionFixed) {
            el.css({
                'position': 'absolute',
                'bottom': '30px',
                'top': 'unset',
            });
            // console.log("third");
        }
        let scrollBottom = $(document).height() - $(window).height() - $(this).scrollTop();
        // console.log(scrollBottom);
    });
</script>

@endsection