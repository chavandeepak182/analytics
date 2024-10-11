@extends('front.layout.layout')
@section('title','Research Methodology')
@section('content')
<style>
    .scrolling-images-div .ipad-carousel .item {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .rm-content .icon-box-img {
        margin-bottom: 0;
        width: 40%;
    }
    .rm-content .icon-box-img img {
      height: 100%;
      width: 150px;
    }
    .iq-icon-box {
        margin-top: 25px;
        width: 100%;
    }
    .col-md-4 .iq-icon-box {
        width: 100%;
        padding: 15px;
        margin-bottom: 0;
        height: 231px;
        border-color: #f2f2f4;
        background: #ffffff;
        box-shadow: 4.871px 34.659px 30px 0px rgba(0, 0, 0, 0.06);
    }
    .col-md-4 .iq-icon-box .iq-icon-box-style-1 .icon-box-desc {
        background: #fff;
    }
    .col-md-4  .icon-box-img{
        width: 100%;
    height: 95px;
    padding-right: 15px;
    }
    .col-md-4  .icon-box-title a:hover{
    text-decoration: none;
    }
</style>
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black privacy-policy-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Research Methodology</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item"><a href="{{url('aboutus')}}">About Us </a></li>
                                <li class="breadcrumb-item active">Research Methodology</li>
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
<!-- Section 1 -->

<section class="bg-white research-methodology iq-ptb-60">
    <div class="container">
        <div class="research-methodology-content">
            <div class="rm-content">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                        <div class=" text-left iq-title-default iq-title-box-2 ">
                            <h2 class="iq-title text-capitalize">{{!empty($research->section_1_heading)?$research->section_1_heading:''}}</h2>
                            {!!  !empty($research->section_1_description)?$research->section_1_description:'' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section 1 -->
<!-- Section 2 -->
<section class="bg-gray research-methodology iq-ptb-60">
    <div class="container">
        <div class="research-methodology-content">
            <div class="rm-content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                        <div class=" text-left iq-title-default iq-title-box-2 ">
                            <h2 class="iq-title text-capitalize">{{!empty($research->section_2_heading)?$research->section_2_heading:''}}</h2>
                            {!!  !empty($research->section_2_description)?$research->section_2_description:'' !!}   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section 2 -->
<!-- Section 3 -->
<section class="bg-white research-methodology iq-ptb-60">
    <div class="container">
        <div class="research-methodology-content">
            <div class="rm-content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                        <div class=" text-left iq-title-default iq-title-box-2 ">
                            <h2 class="iq-title text-capitalize">{{!empty($research->section_3_heading)?$research->section_3_heading:''}}</h2>
                            {!! !empty($research->section_3_description)?$research->section_3_description:'' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section 3 -->
<!-- Section 4 -->
<section class="bg-gray research-methodology iq-ptb-60">
    <div class="container">
        <div class="research-methodology-content">
            <div class="rm-content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInRight">
                        <div class=" text-left iq-title-default iq-title-box-2 ">
                            <h2 class="iq-title text-capitalize">{{!empty($research->section_4_heading)?$research->section_4_heading:''}}</h2>
                            {!! !empty($research->section_4_description_1)?$research->section_4_description_1:'' !!}
                            <div class="iq-icon-box iq-icon-box-style-5 bg-white iq-box-shadow border-bottom-box">
                                <div class="icon-box-img">
                                    <img src="{{!empty($research->section_4_image_path_1) && Storage::exists($research->section_4_image_path_1) ? url('/').Storage::url($research->section_4_image_path_1) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100" alt="{{!empty($research->section_4_image_name_1)?$research->section_4_image_name_1:'default image'}}">
                                </div>
                                <div class="icon-box-content text-left">
                                   <div class="rm-box-list">
                                        {!! !empty($research->section_4_description_2)?$research->section_4_description_2:'' !!}
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 wow fadeInUp" data-wow-duration="1.1s">
                                    <div class="iq-icon-box iq-icon-box-style-1">
                                        <div class="icon-box-img">
                                            <img src="{{!empty($research->section_4_image_path_2) && Storage::exists($research->section_4_image_path_2) ? url('/').Storage::url($research->section_4_image_path_2) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="{{!empty($research->section_4_image_name_2)?$research->section_4_image_name_2:'default image'}}">
                                        </div>
                                        <div class="icon-box-content">
                                            <h5 class="icon-box-title"> <a href="javascript:void(0)">{{!empty($research->section_4_sub_heading_1)?$research->section_4_sub_heading_1:''}}</a></h5>
                                            <p class="icon-box-desc"> {!! !empty($research->section_4_sub_description_1)?$research->section_4_sub_description_1:'' !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 wow fadeInUp" data-wow-duration="1.3s">
                                    <div class="iq-icon-box iq-icon-box-style-1">
                                        <div class="icon-box-img">
                                            <img src="{{!empty($research->section_4_image_path_3) && Storage::exists($research->section_4_image_path_3) ?url('/').Storage::url($research->section_4_image_path_3) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="{{!empty($research->section_4_image_name_3)?$research->section_4_image_name_3:'default image'}}">
                                        </div>
                                        <div class="icon-box-content">
                                            <h5 class="icon-box-title"> <a href="javascript:void(0)">{{!empty($research->section_4_sub_heading_2)?$research->section_4_sub_heading_2:''}}</a></h5>
                                            <p class="icon-box-desc"> {!! !empty($research->section_4_sub_description_2)?$research->section_4_sub_description_2:'' !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 wow fadeInUp" data-wow-duration="1.5s">
                                    <div class="iq-icon-box iq-icon-box-style-1">
                                        <div class="icon-box-img">
                                            <img src="{{!empty($research->section_4_image_path_4) && Storage::exists($research->section_4_image_path_4) ?url('/').Storage::url($research->section_4_image_path_4) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="{{!empty($research->section_4_image_name_4)?$research->section_4_image_name_4:'default image'}}">
                                        </div>
                                        <div class="icon-box-content">
                                            <h5 class="icon-box-title"> <a href="javascript:void(0)">{{!empty($research->section_4_sub_heading_3)?$research->section_4_sub_heading_3:''}}</a></h5>
                                            <p class="icon-box-desc"> {!! !empty($research->section_4_sub_description_3)?$research->section_4_sub_description_3:'' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section 4 -->
<!-- Section 5 -->
<section class="bg-white research-methodology iq-ptb-60">
    <div class="container">
        <div class="research-methodology-content">
            <div class="rm-imgages">
                <div class="row">
                    <div class="col-md-12">
                        <div class="scrolling-images-div">
                            <div class="scrolling-outer-box">
                                <div class="tab-img ">
                                    <img src="{{URL::asset('front/images/new-images/research-methodology/tab-image.webp')}}" alt="">
                                </div>
                            </div>
                            <div class="ipad-carousel owl-carousel" data-autoplay="true" data-loop="true" data-nav="true"
                                    data-dots="false" data-items="1" data-items-laptop="1" data-items-tab="1"
                                    data-items-mobile="1" data-items-mobile-sm="1" data-margin="">
                                @if(!empty($banner))
                                    @foreach ($banner as $bannerData )
                                        <div class="item">
                                            <div class="landing-page-slider">
                                                <img src="{{!empty($bannerData->image_path) && Storage::exists($bannerData->image_path) ? url('/').Storage::url($bannerData->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" alt="">
                                            </div>
                                        </div>   
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section 5 -->

<!-- Iconbox End -->

@endsection
@section('script')

<script></script>


<script type="text/javascript">
   $("#navbar").removeClass("nav-page");
   $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
   $(".home_active").removeClass("active");
   $(".about_active").addClass("active");
   $(".research_methodology_active").addClass("active");
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });



    $('.ipad-carousel').owlCarousel({
    loop:true,
    margin:5,
    nav:true,
    dots:false,
    autoplay: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
  </script>

@endsection