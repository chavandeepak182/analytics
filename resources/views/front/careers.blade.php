@extends('front.layout.layout')
@section('title','Careers')
@section('content')
@include('front.layout.notifications')

<style>
    .MainCaptchaDiv #UserCaptchaCode:hover,  .MainCaptchaDiv #UserCaptchaCode:focus{
        border: 1px solid transparent !important;
    }
    .career_form_field.MainCaptchaDiv{
        flex-direction: column;
    }
    .career_form_btn{
        margin-left: 0;
    }
    input,
    input[type=text],
    input[type=email],
    input[type=search],
    input[type=password],
    textarea{
        color: white !important;
    }
</style>

<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black careers-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Careers</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item"><a href="{{url('aboutus')}}">About Us </a></li>
                                <li class="breadcrumb-item active">Careers</li>
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
<section class="careers">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-left" alt="QLOUD">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-right" alt="1">
    <div class="container">
        <div class="careers_content bg-white">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="text-center iq-title-box iq-title-default iq-title-box-2 wow fadeInUp" data-wow-duration="0.6s" style="visibility: visible; animation-duration: 0.6s; animation-name: fadeInUp;">
                         <h2 class="iq-title">{{!empty($career->heading)?$career->heading:''}}</h2>
                    </div>
                    <div class="iq-icon-box iq-icon-box-style-5 bg-white iq-box-shadow wow fadeInUp" data-wow-duration="0.7s" style="visibility: visible; animation-duration: 0.6s; animation-name: fadeInUp;">
                        <div class="icon-box-content">
                            {!!!empty($career->description)?$career->description:''!!}
                        </div>
                    </div>
                </div>

                @foreach ($openings as $opening_data )
                    <div class="col-lg-4 col-md-6 mb-150 wow fadeInLeft" data-wow-duration="0.6s" style="visibility: visible; animation-duration: 0.6s; animation-name: fadeInLeft;">
                        <div class="career_card career_work ">
                            <div class="career_img-section">
                                <img src="{{URL::asset('front/images/new-images/career/join-us.png')}}" class="cr_img" alt="vacancy">
                            </div>
                            <div class="career_card-desc">
                                <div class="career_card-time">{{!empty($opening_data->heading)?$opening_data->heading:''}}</div>
                                <div class="career_location">
                                    <p class="career_recent"><i class="fa fa-suitcase"></i>{{!empty($opening_data->number_of_positions)?$opening_data->number_of_positions:''}}</p>
                                    <p class="career_recent"><i class="fa fa-clock-o"></i>{{!empty($opening_data->experience)?$opening_data->experience:''}}</p>
                                    <p class="career_recent"><i class="fa fa fa-map-marker"></i>{{!empty($opening_data->location)?$opening_data->location:''}}</p>
                                </div>
                                <div class="career_btn">
                                    <button id="apply-now-btn" class="custom-btn btn-2 openings" data-title="{{!empty($opening_data->heading)?$opening_data->heading:''}}"  data-id="{{!empty($opening_data->id)?$opening_data->id:''}}" data-toggle="modal"   data-target="#exampleModals">Apply Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Iconbox End -->

<!-- Career Form Modal -->
<div class="modal fade career-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="career-modal-header">
                    <div class="career_form_title"><span class="modal-job-title"></span></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="form">
                    <div class="career_form_card">
                         <form action="{{route('career.application.store')}}" id="career-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="application_for" id="application_for_input" value="">
                            <div class="career_form_field">
                                <i aria-hidden="true" class="ion ion-ios-person"></i>
                                <input placeholder="Full Name" class="career_form_input-field" type="text" name="name">
                                
                            </div>
                            <div class="career_form_field">
                                <i aria-hidden="true" class="ion ion-ios-email"></i>
                                <input placeholder="Email" class="career_form_input-field" type="mail" name="email">
                            </div>
                            <div class="career_form_field">
                                <i aria-hidden="true" class="ion ion-ios-telephone"></i>
                                <input placeholder="Phone No." class="career_form_input-field" type="text" name="phone" >
                            </div>
          
                            <div class="career_form_field for-textarea">
                                <i aria-hidden="true" class="ion ion-document-text"></i>
                                <span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="46" rows="12" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span>
                            </div>

                            <div class="career_form_field">
                                <input type="file" class="form-control upload-file" aria-label="file example" name="file_path">
                            </div>

                            <fieldset class="career_form_field MainCaptchaDiv">
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

                            <button class="career_form_btn form-submit-btn" type="button" onclick="CheckCaptcha();"
                            >Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Career Form Modal -->

@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".about_active").addClass("active");
    $(".careers-active").addClass("active");
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
      $("#career-form").submit();
    }
  }  
  }
</script>


<!-- <script>
$(document).on("click", ".openings", function (){
    var id = $(this).data("id");
         $.ajax({
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/openings-form-heading",
            success: function (response) {
                  var headingValue = response.data.heading;
                  $('#application_for_input').val(headingValue);

                 $('.modal-job-title').html(response.data.heading);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    
});  
</script>  -->

<script>
    $(".openings").each(function(){
        $(this).click(function(){
            $(".career_form_title").html("Apply - "+$(this).attr("data-title"));
            $("#application_for_input").val($(this).attr("data-title"));
            $("#exampleModal").modal("show");
        })
    })
</script>

<script>
    $(document).ready(function () {
        // Function to validate the form
        function validateForm() {
            var isValid = true;

            // Clear previous error messages
            $('.error').text('');

            // Validate Full Name
            var name = $('#career-form input[name="name"]').val();
            if (name === '') {
                $('#career-form .name-error').text('Please enter your full name.');
                isValid = false;
            }

            // Validate Email
            var email = $('#career-form input[name="email"]').val();
            if (email === '') {
                $('#career-form .email-error').text('Please enter your email address.');
                isValid = false;
            }

            // Validate Phone Number
            var phone = $('#career-form input[name="phone"]').val();
            if (phone === '') {
                $('#career-form .phone-error').text('Please enter your phone number.');
                isValid = false;
            }

            // Validate Message
            var message = $('#career-form textarea[name="message"]').val();
            if (message === '') {
                $('#career-form .message-error').text('Please enter a message.');
                isValid = false;
            }

            // Validate Captcha
            var captchaCode = $('#UserCaptchaCode').val();
            if (captchaCode === '') {
                $('#WrongCaptchaError').text('Please enter the captcha code.');
                isValid = false;
            }

            // Validate File (PDF) Upload
            var fileInput = $('#career-form input[name="file_path"]');
            var fileName = fileInput.val();
            if (fileName && !checkFileType(fileName)) {
                $('#career-form .file-error').text('Please select a PDF file.');
                isValid = false;
            }

            return isValid;
        }

        // Function to check file type
        function checkFileType(file) {
            var allowedExtensions = /(\.pdf)$/i;
            return allowedExtensions.test(file);
        }

        // // Submit button click event
        // $('#career-form .career_form_btn').on('click', function () {
        //     if (!validateForm()) {
        //         return false; // Prevent form submission if validation fails
        //     }
        // });
    });
</script>

@endsection