<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @php
        $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('favicon_image_path','favicon_image_name')->first();
    @endphp 
    <link rel="shortcut icon" href="{{ !empty($logo_image->favicon_image_path) && Storage::exists($logo_image->favicon_image_path) ? url('/').Storage::url($logo_image->favicon_image_path) : asset('front/images/we-favicon.png') }}" />
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet"
        href="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ URL::asset('admin_panel/commonarea/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="{{ URL::asset('admin_panel/commonarea/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/jvectormap/jquery-jvectormap.css') }}">

    <!-- <link rel="shortcut icon" href="{{ URL::asset('frontend/assets/images/favicon.ico') }}" type="image/x-icon"> -->

    <!-- Favicon -->
    
    <link rel="icon" href="{{ !empty($favicon_image->favicon_image_path) ? $favicon_image->favicon_image_path : URL::asset('admin_panel/commonarea/dist/img/favicon.png') }}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/login.css') }}">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jquery -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/js/jquery.toast.min.css') }}">

    <script src="{{ URL::asset('admin_panel/js/jquery.validate.min.js') }}"></script>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .checkbox input[type="checkbox"],
        .checkbox-inline input[type="checkbox"],
        .radio input[type="radio"],
        .radio-inline input[type="radio"] {
            position: relative !important;
            margin-left: 0px !important;
        }

        .admin-login-page-icon {
            height: 75px;
            object-fit: cover;
            /* background-color: #272727; */
            padding: 6px;
            margin-bottom: 30px;
        }

        a {
            color: #2f4e9b;
        }

        a:hover,
        a:active,
        a:focus {
            outline: none;
            text-decoration: none;
            color: #264080;
        }
        .mb-40 {
            margin-bottom: 40px;
        }
        .mb-30 {
            margin-bottom: 30px;
        }
        .mt-30 {
            margin-top: 30px;
        }
        .mb-15{
            margin-bottom: 15px;
        }
        .login-input-div {
            margin-bottom: 70px !important;
        }
        .success-bg{
            background-color: #5da954;
        }
        .error-bg{
            background-color: #e53e3e;
        }
        #loginForm .message{
            padding: 5px;
            width: 100%;
            color: #fff;
            position: absolute;
            top: 0;
        }
    </style>
</head>
<body class="hold-transition login-page">
    @include('../.../front.layout.notifications')
    <div class="container" id="container">
        <div class="form-container sign-in-container">

            <form action="{{ route('reset.password.post') }}" method="post" id="loginForm" autocomplete="on">
                @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                
                @csrf
                <div class="col-md-12 mt-30">
                    <img src="{{ URL::asset('admin_panel/commonarea/dist/img/logo.png') }}" alt="" class="admin-login-page-icon">
                </div>
                <!-- <div class="col-md-12 mb-40">
                    <h1>Change Password</h1>
                </div> -->
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="col-md-12 mb-15">
                    <div class="login-input-div for-pass">
                        <div class="inputBox">
                            <input type="text" id="email_address" name="email" autocomplete="off">
                            <span>Email</span>
                            <div class="pass-show"><i class="fa fa-eye"></i></div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mb-15">
                    <div class="login-input-div for-pass">
                        <div class="inputBox">
                            <input type="password" id="password-confirm" name="password">
                            <span>New Password</span>
                            <div class="pass-show"><i class="fa fa-eye"></i></div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger mb-5">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mb-15">
                    <div class="login-input-div for-pass">
                        <div class="inputBox">
                            <input type="password" id="password-confirm" name="password_confirmation">
                            <span>Confirm Password</span>
                            <div class="pass-show"><i class="fa fa-eye"></i></div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger mb-5" >{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mb-30">
                    <button type="submit" class="login-btn submit">Update</button>
                </div>
                @if (Session::has('error'))
                    <div class="message error-bg">
                        {{ Session::get('error') }}
                    </div>
                @endif     
                @if (Session::has('success'))
                    <div class="message success-bg">
                        {{ Session::get('success') }}
                    </div>
                @endif     
            </form>
        </div>
    </div>
<script src="{{ URL::asset('admin_panel/js/jquery.validate.js')}}"></script>
<script src="{{ URL::asset('admin_panel/js/jquery.toast.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    $(".pass-show").on('click', function() {
      var passwordId = $(this).siblings();
      console.log("passwordId........", passwordId)
      if (passwordId.attr("type") === "password") {
        passwordId.attr("type", "text");
        $(this).find("i").removeClass("fa-eye")
        $(this).find("i").addClass("fa-eye-slash")
      } else {
        passwordId.attr("type", "password");
        $(this).find("i").addClass("fa-eye")
        $(this).find("i").removeClass("fa-eye-slash")
      }
    })
</script>
    
<script>
    $('#email').keyup(function() {
        this.value = this.value.toLowerCase();
    });
</script>

<script>
    $(document).ready(function () {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "* Please enter your email.",
                    email : "* Please enter valid email."
                },
                password: {
                    required: "* Please enter password.",
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

</body>

</html>
