<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>

    <style>
        label {
            color: red;
        }
    </style>
    @php
        $favicon_image = App\Models\VisualSettings::where('status', '=', 'active')
            ->select('favicon_image_path', 'favicon_image_name')
            ->first();
    @endphp
    <link rel="shortcut icon"
        href="{{ !empty($favicon_image->favicon_image_path) ? $favicon_image->favicon_image_path : URL::asset('frontend/assets/images/favicon.ico') }}"
        type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
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
    <!-- iCheck -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/login.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="forgot-password-container" id="container">

        <div class="form-container forgot-password-form">
            <form action="{{ url('admin/send-otp') }}" method="POST" id="forgetpasswordForm">
                @csrf
                <h1>Forgot Password</h1>
                <p class="mb-50px">Enter the email associated with your account and we'll send OTP to reset your
                    password</p>
                @if ($errors->has('email'))
                    <div class="error text-danger"><strong>{{ $errors->first('email') }}</strong></div>
                @endif
                <input type="email" name="email" placeholder="Enter Email" id="email" />

                {{-- <a class="login-btn" href="{{url('otp')}}">Send OTP</a> --}}
                <div class="col-md-12">
                    <button type="submit" class="login-btn">Send OTP</button>
                </div>
            </form>
        </div>
        <!-- <div class="overlay-container">
  <div class="overlay">
  
    <div class="overlay-panel overlay-right">
    <h1>Property Tax Billing</h1>
     
   </div>
  </div> -->
    </div>

    <!-- /.login-box -->
    <script src="{{ URL::asset('admin_panel/commonarea/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('admin_panel/js/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('admin_panel/js/validations/custom/settings/forget_password.js') }}"></script>
    <!-- jQuery 3 -->
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
    <script>
        $('#email').keyup(function() {
            this.value = this.value.toLowerCase();
        });
    </script>
</body>

</html>
