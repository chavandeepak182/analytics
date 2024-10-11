@extends('front.layout.layout')
@section('title','Contact Us')
@section('content')

<style>
    .iq-contact-frame textarea {
border-radius: 6px;
    }
    .MainCaptchaDiv #CaptchaImageCode {
    width: 243px !important;
    height: 51px !important;
}
    .MainCaptchaDiv #CapCode, .MainCaptchaDiv #UserCaptchaCode {
    height: 51px !important;
}
.MainCaptchaDiv .CaptchaTxtField {
    border-radius: 6px;
}
    .MainCaptchaDiv #UserCaptchaCode {
    margin-bottom: 0 !important;
    border: 1px solid #eeeeee !important;
    color: #59597e !important;
    padding: 5px 20px 5px 20px !important;
    border-radius: 6px;
}
.MainCaptchaDiv {
    margin-bottom: 30px;
}
</style>
@include('front.layout.notifications')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black contact-us-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Contact Us</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Iconbox Start -->
<section class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-4  col-md-6">
                <div class="iq-icon-box iq-icon-box-style-2 text-left ">

                    <div class="icon-box-img">
                        <i aria-hidden="true" class="ion ion-ios-location"></i>
                    </div>
                    <div class="icon-box-content">
                        <h5 class="icon-box-title"><a href="javascript:void(0)">Location</a></h5>
                        <p class="icon-box-desc">{{!empty($contacts->address)?$contacts->address:''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-md-6">
                <div class="iq-icon-box iq-icon-box-style-2 text-left ">
                    <div class="icon-box-img">
                        <i aria-hidden="true" class="ion ion-ios-email"></i>
                    </div>
                    <div class="icon-box-content">
                        <h5 class="icon-box-title"> <a href="javascript:void(0)">Email</a></h5>
                        <a href="mailto:{{!empty($contacts->email)?$contacts->email:''}}">{{!empty($contacts->email)?$contacts->email:''}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-md-6">
                <div class="iq-icon-box iq-icon-box-style-2 text-left ">
                    <div class="icon-box-img">
                        <i aria-hidden="true" class="ion ion-ios-telephone"></i>
                    </div>
                    <div class="icon-box-content">
                        <h5 class="icon-box-title"> <a href="javascript:void(0)">Phone</a></h5>
                        <a class="icon-box-desc" href="tel:{{!empty($contacts->mobile)?$contacts->mobile:''}}"><span>{{!empty($contacts->mobile)?$contacts->mobile:''}}</span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Iconbox End -->

<section class="iq-contact-frame pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <iframe src="{{!empty($contacts->map_link)?$contacts->map_link:''}}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                <div class=" text-left iq-title-box iq-title-default iq-title-box-2">
                    <div class="iq-title-icon"></div>
                    <span class="iq-subtitle">Get In Touch</span>
                    <h2 class="iq-title">Contact With US </h2>
                </div>
                <div role="form" class="wpcf7" id="wpcf7-f790-p785-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="{{route('contact.us.query')}}" method="post" class="wpcf7-form" id="contact-form" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="type" value="contact">
                        <div class=row>
                            <div class="col-lg-6 col-md-6 ">
                                @if($errors->has('fname'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('fname')}}</span>
                                @endif
                                <span class="wpcf7-form-control-wrap first-name"><input type="text" name="fname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="First Name" /></span>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                @if($errors->has('lname'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('lname')}}</span>
                                @endif
                                <span class="wpcf7-form-control-wrap last-name"><input type="text" name="lname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Last Name" /></span>
                            </div>
                            
                            <div class="col-lg-12">
                                @if($errors->has('email'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('email')}}</span>
                                @endif
                                <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email Address" /></span>
                            </div>
                            
                            <div class="col-lg-6">
                                @if($errors->has('phone'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('phone')}}</span>
                                @endif
                                <span class="wpcf7-form-control-wrap tel-554"><input type="tel" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" placeholder="Phone" /></span>
                            </div>
                            
                            <div class="col-lg-6">
                                @if($errors->has('company'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('company')}}</span>
                                @endif
                                <span class="wpcf7-form-control-wrap company"><input type="text" name="company" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Enter Company" /></span>
                            </div>
                           
                            <div class="col-lg-12">
                                @if($errors->has('message'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('message')}}</span>
                                @endif
                                <p><span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span></p>
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
    $(".contact_active").addClass("active");
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
    //   var e = alpha[Math.floor(Math.random() * alpha.length)];
    //   var f = alpha[Math.floor(Math.random() * alpha.length)];
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
      $("#contact-form").submit();
    }
  }  
  }
</script>

@endsection