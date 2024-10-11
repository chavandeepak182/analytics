@extends('front.layout.layout')
@section('title','Services')
@section('content')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black services-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Services</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Services</li>
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
<section class="media-citations services-page">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-left" alt="QLOUD">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-right" alt="1">
    <div class="container">
        <div class="row">
            @php
               $service1=App\Models\Arm_services_consulting::where('status', '=', 'active')->first();
            @endphp  
            <div class="col-lg-4 mb-5 wow fadeInLeft" data-wow-duration="0.6s">
                <div class="service-card">
                    <a href="{{url('/services/consulting')}}">
                        <div class="service-card-img">
                            <img src="{{!empty($service1->banner_image_path) && Storage::exists($service1->banner_image_path) ? url('/').Storage::url($service1->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100" alt="Forbes">
                        </div>
                        <div class="service-card-details">
                            <p class="service-text-title">{{!empty($service1->banner_heading)?$service1->banner_heading:''}}</p>
                            <p class="service-text-body"> {{ substr(strip_tags(!empty($service1->description)?$service1->description:''), 0, 200) . '...'}}</p>
                        </div>
                    </a>
                    <a href="{{url('/services/consulting')}}" class="service-card-button">More info</a>
                </div>
            </div>
            
            @php
               $service2=App\Models\Arm_service_subscription::where('status', '=', 'active')->first();
            @endphp 
            <div class="col-lg-4 mb-5 wow fadeInLeft" data-wow-duration="0.8s">
                <div class="service-card">
                    <a href="{{url('/services/subscription')}}">
                        <div class="service-card-img">
                            <img src="{{!empty($service2->banner_image_path) && Storage::exists($service2->banner_image_path) ?url('/').Storage::url($service2->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100" alt="Forbes">
                        </div>
                        <div class="service-card-details">
                            <p class="service-text-title">{{!empty($service2->banner_heading)?$service2->banner_heading:''}}</p>
                            <p class="service-text-body">{{ substr(strip_tags(!empty($service2->description)?$service2->description:''), 0, 200) . '...'}}</p>
                        </div>
                    </a>
                    <a href="{{url('/services/subscription')}}" class="service-card-button">More info</a>
                </div>

            </div>
            
            @php
               $service3=App\Models\Arm_service_custom_research::where('status', '=', 'active')->first();
            @endphp
            <div class="col-lg-4 mb-5 wow fadeInLeft" data-wow-duration="1s">
                <div class="service-card">
                    <a href="{{url('/services/custom-market-research')}}">
                        <div class="service-card-img">
                            <img  src="{{!empty($service3->banner_image_path) && Storage::exists($service3->banner_image_path) ? url('/').Storage::url($service3->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100" alt="Forbes">
                        </div>
                        <div class="service-card-details">
                            <p class="service-text-title">{{!empty($service3->banner_heading)?$service3->banner_heading:''}}</p>
                            <p class="service-text-body">{{ substr(strip_tags(!empty($service3->description)?$service3->description:''), 0, 200) . '...'}}</p>
                        </div>
                    </a>
                    <a href="{{url('/services/custom-market-research')}}" class="service-card-button">More info</a>
                </div>

            </div>
            @php
               $service4=App\Models\Arm_service_we_market_client_support::where('status', '=', 'active')->first();
            @endphp
            <div class="col-lg-4 mb-5 wow fadeInLeft" data-wow-duration="1.2s">
                <div class="service-card">
                    <a href="{{url('/services/we-market-client-support')}}">
                        <div class="service-card-img">
                            <img  src="{{!empty($service4->banner_image_path) && Storage::exists($service4->banner_image_path) ? url('/').Storage::url($service4->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100" alt="Forbes">
                        </div>
                        <div class="service-card-details">
                            <p class="service-text-title">{{!empty($service4->banner_heading)?$service4->banner_heading:''}}</p>
                            <p class="service-text-body">{{ substr(strip_tags(!empty($service4->description)?$service4->description:''), 0, 200) . '...'}}</p>
                        </div>
                    </a>
                    <a href="{{url('/services/we-market-client-support')}}" class="service-card-button">More info</a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Iconbox End -->
@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".services_active").addClass("active");
</script>

@endsection