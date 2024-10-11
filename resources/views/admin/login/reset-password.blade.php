<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>

  <style>
    .error {
      color: red;
    }
  </style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->

  <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/dist/css/login.css')}}">
  @php
    $favicon_image = App\Models\VisualSettings::where('status','=','active')->select('favicon_image_path','favicon_image_name')->first();
  @endphp
  <link rel="shortcut icon" href="{{!empty($favicon_image->favicon_image_path) ? $favicon_image->favicon_image_path : URL::asset('frontend/assets/images/favicon.ico')}}" type="image/x-icon">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jquery -->
  <link rel="stylesheet" href="{{ URL::asset('admin_panel/js/jquery.toast.min.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="{{ URL::asset('admin_panel/js/jquery.validate.min.js')}}"></script>

</head>

<body class="hold-transition login-page">
  <div class="forgot-password-container" id="container">
    <div class="form-container forgot-password-form">
      <form action="{{url('admin/new-password')}}" method="post" id="confirmpasswordForm" role="form">
        @csrf
        <h1>Reset Your Password</h1>
        <p class="mb-50px ">Check Your Email For OTP</p>
        <div class="col-md-12">
          <input type="password" name="new_password" id="password" placeholder="New Password">
          @if($errors->has('new_password'))
          <div class="error text-danger"><strong>{{$errors->first('new_password')}}</strong></div>
          @endif
          <span class="pass-show"><i class="fa fa-eye"></i></span>
        </div>
        <div class="col-md-12">
          <input type="password" name="confirm_password" id="confirmpassword" placeholder="Confirm Password">
          @if($errors->has('confirm_password'))
          <div class="error text-danger"><strong>{{$errors->first('confirm_password')}}</strong></div>
          @endif
          <span class="pass-show"><i class="fa fa-eye"></i></span>
        </div>
        <div class="col-md-12">
          <button type="submit" class="login-btn submit">Continue</button>
        </div>
      </form>
    </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{URL::asset('admin_panel/commonarea/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('admin_panel/js/jquery.validate.min.js')}}"></script>
  <script src="{{ URL::asset('admin_panel/js/validations/custom/settings/change_password.js')}}"></script>

  <!-- jQuery 3 -->
  <!-- Bootstrap 3.3.7 -->
  <script src="{{URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- iCheck -->


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
    @if(Session::has('success'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
    }
    toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
    }
    toastr.error("{{ session('error') }}");
    @endif
  </script>

<script>
  function success_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'success',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }

  function fail_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'error',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }
</script>
</body>

</html>