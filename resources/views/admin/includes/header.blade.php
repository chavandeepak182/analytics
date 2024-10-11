<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('meta_title', 'Admin')</title>
    <meta name="description" content="@yield('meta_description', 'Default Description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default, Keywords')">
    

    {{-- <title>Admin </title> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- FAVICON -->
    @php
        $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('favicon_image_path','favicon_image_name')->first();
    @endphp 
    <link rel="shortcut icon" href="{{ !empty($logo_image->favicon_image_path) && Storage::exists($logo_image->favicon_image_path) ? url('/').Storage::url($logo_image->favicon_image_path) : asset('front/images/we-favicon.png') }}" />
    <!-- <link rel="icon" href="{{ !empty($favicon_image->favicon_image_path) ? $favicon_image->favicon_image_path : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" type="image/png" sizes="16x16"> -->

    <!-- Bootstrap 3.3.7 -->
    <link rel="shortcut icon" href="{{ URL::asset('frontend/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <!-- timepicker -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/timepicker/bootstrap-timepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Select 2 css CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   

   

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/iCheck/square/purple.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/css/file-uploader.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/style.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/jquery.datatables.css') }}">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Summer note -->

    <link rel="stylesheet" href="{{URL::asset('admin_panel/commonarea/plugins/summernote/summernote0226.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/summernote/summernote.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- fselect -->
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/fSelect.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/dist/css/multiple-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/fixedHeader.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_panel/js/jquery.toast.min.css') }}">

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- Swiper JS -->

    <script src="{{ URL::asset('admin_panel/js/jquery.validate.min.js') }}"></script>

    <script src="{{ URL::asset('admin_panel/commonarea/dist/js/multiple-select.min.js') }}"></script>

    <script src="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>

    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: #fff;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #4a429e;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #667bb4;
            -webkit-animation: spin 3s linear infinite;
            animation: spin 3s linear infinite;
        }

        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #fd57cf;
            -webkit-animation: spin 1.5s linear infinite;
            animation: spin 1.5s linear infinite;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .pre_span {
            position: fixed;
            left: calc(50% - 36px);
            top: calc(50% - 50px);
        }

        .pre_span img {
            width: 75px;
            padding-top: 17px;
        }
    </style>

</head>


<body onload="loadFunction()" class="skin-blue sidebar-mini scrollbar" id="style-7" style="height: auto; min-height: 100%;">
    <!--<div class="loader3" id="preloader" style="display: none;">-->
    <input type="hidden" value="{{ url('/') }}" id="base_url" />
    <div id="preloader" style="display: none;">
        <div id="loader">

        </div>
    </div>
    <div class="wrapper" style="height: auto; min-height: 100%;"></div>

    <script>
        function loadFunction() {
            $('#preloader').hide();
        }
    </script>