@extends('front.layout.layout')

@section('title',!empty($service->meta_title)?$service->meta_title:'')

@section('meta_description',!empty($service->meta_keyword)?$service->meta_keyword:'')

@section('meta_keywords', !empty($service->meta_description)?$service->meta_description:'')

@section('content')

<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid pt-2">
        <div class="text-left iq-breadcrumb-one iq-bg-over black service-view-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">{{!empty($service->banner_heading)?$service->banner_heading:''}}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item"><a href="{{url('services')}}">Services </a></li>
                                <li class="breadcrumb-item active">{{!empty($service->banner_heading)?$service->banner_heading:''}}- We Market Knowledge Based</li>
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
<section class="pt-0">
    <div class="iq-blog-section service-view">
        <div class="service-view-img">
            <img src="{{!empty($service->banner_image_path) && Storage::exists($service->banner_image_path) ? url('/').Storage::url($service->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100 service-view-img" alt="Forbes">
        </div>
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-12 col-sm-12 mb-lg-0 mb-5  bg-white service-view-div">
                    <div class="content-card">
                        <div class="service-view-content">
                              {!! !empty($service->description)?$service->description :''!!}
                        </div>
                    </div>
                </div>
            </div><!-- #row -->
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
    $(".subscription_active").addClass("active");
    $(".we-market-knowledge-active").addClass("active");
</script>

@endsection