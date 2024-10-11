<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

    </style>
</head>
<body class="hold-transition login-page">
    @include('../.../front.layout.notifications')
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="{{ url('login-action') }}" method="post" id="loginForm">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                @csrf
                <div class="col-md-12">
                    <img src="{{ URL::asset('admin_panel/commonarea/dist/img/logo.png') }}" alt="" class="admin-login-page-icon">
                </div>
                <div class="col-md-12">
                    <h1>Enter OTP</h1>
                    <p class="mb-40px">Check Your Email For OTP</p>
                </div>
                <div class="col-md-12">
                    <div class="login-input-div">
                        <div class="inputBox">
                            <input type="text" name="email" id="email">
                            <span class="user">Enter OTP</span>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="login-input-div for-pass">
                        <div class="inputBox">
                            <input type="password" name="password" id="password">
                            <span>Password</span>
                            <div class="pass-show"><i class="fa fa-eye"></i></div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-12">
                    <div class="pad-10px mb-10px">
                        <a href="{{ route('forget.password.get') }}">Forgot your password?</a>
                    </div>
                </div> -->

                <div class="col-md-12">
                    <button type="submit" class="login-btn submit">Send OTP</button>
                </div>
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
