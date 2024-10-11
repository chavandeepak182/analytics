@extends('front.layout.layout')

@section('title',!empty($about->meta_title)?$about->meta_title:'')

@section('meta_description',!empty($about->meta_keyword)?$about->meta_keyword:'')

@section('meta_keywords', !empty($about->meta_description)?$about->meta_description:'')

@section('content')

<!-- Breadcrumb Start -->
<div class=" main-bg">
   <div class="container-fluid p-0">
      <div class="text-left iq-breadcrumb-one iq-bg-over black about-us-banner ">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-sm-12">
                  <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                     <h2 class="title">About Us</h2>
                     <ol class="breadcrumb main-bg">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active"> About Us</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Breadcrumb End -->
<!-- About-Us Start -->
<section class="about-us-page" id="about-us-section">
   <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-right" alt="QLOUD">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-sm-12 mb-lg-0 mb-4 wow fadeInLeft">
            <img src="{{!empty($about->section_1_image_path) && (Storage::exists($about->section_1_image_path)) ? url('/').Storage::url($about->section_1_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100 border-r5" alt="{{!empty($about->section_1_image_name)?$about->section_1_image_name:''}}" />
         </div>
         <div class="col-lg-6 col-sm-12 wow fadeInRight">
            <div class=" text-left iq-title-box iq-title-default iq-title-box-2 home-about_content">
               <h2 class="iq-title text-capitalize">{{!empty($about->section_1_heading)?$about->section_1_heading:''}}</h2>
               {!! !empty($about->section_1_description_1)?$about->section_1_description_1:''!!}
            </div>
         </div>
          <div class="col-lg-12 col-sm-12 wow fadeInRight">
            <div class=" text-left iq-title-box iq-title-default iq-title-box-2 home-about_content">
                {!! !empty($about->section_1_description_2)?$about->section_1_description_2:''!!}
            </div>
         </div>
      </div>
   </div>
</section>
<!-- About-Us End -->
<!-- Vision Start -->
<section class="gray-bg vission-mission">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="iq-tabs iq-tab-vertical iq-hosting ">
               <div class="row ">
                  <div class="col-lg-4">
                     <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="pill" href="#tabs-1" role="tab">
                              <div class="media">
                                 <img src="{{URL::asset('front/images/new-images/about/mission-icon.png')}}" class="" alt="">
                                 <div class="media-body">
                                    <h6 class="tab-title"> {{!empty($about->our_mission)?$about->our_mission:''}}</h6>
                                 </div>
                              </div>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " data-toggle="pill" href="#tabs-2" role="tab">
                              <div class="media">
                                 <img src="{{URL::asset('front/images/new-images/about/value.png')}}" class="" alt="">
                                 <div class="media-body">
                                    <h6 class="tab-title"> {{!empty($about->our_values)?$about->our_values:''}}</h6>
                                 </div>
                              </div>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " data-toggle="pill" href="#tabs-3" role="tab">
                              <div class="media">
                                 <img src="{{URL::asset('front/images/new-images/about/value.png')}}" class="" alt="">
                                 <div class="media-body">
                                    <h6 class="tab-title">{{!empty($about->core_values)?$about->core_values:''}}</h6>
                                 </div>
                              </div>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " data-toggle="pill" href="#tabs-4" role="tab">
                              <div class="media">
                                 <img src="{{URL::asset('front/images/new-images/about/value.png')}}" class="" alt="">
                                 <div class="media-body">
                                    <h6 class="tab-title">{{!empty($about->core_offerings)?$about->core_offerings:''}}</h6>
                                 </div>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="col-lg-8">
                     <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                           {!! !empty($about->our_mission_description)?$about->our_mission_description:''!!}
                        </div>
                        <div class="tab-pane " id="tabs-2" role="tabpanel">
                          {!! !empty($about->our_values_description)?$about->our_values_description:''!!}
                        </div>
                        <div class="tab-pane " id="tabs-3" role="tabpanel">
                          {!! !empty($about->core_values_description)?$about->core_values_description:''!!}
                        </div>
                        <div class="tab-pane " id="tabs-4" role="tabpanel">
                          {!! !empty($about->core_offerings_description)?$about->core_offerings_description:''!!}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>
<!-- Icon-box End -->

<!-- Why Choose Us -->
<section class="why-choose-us" id="why_choose_us">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="text-center iq-title-box iq-title-default iq-title-box-2 wow fadeInUp">
               <div class="iq-title-icon"></div>
               <h2 class="iq-title">{{!empty($about->why_choose_us_heading)?$about->why_choose_us_heading:''}}</h2>
            </div>
         </div>
         <div class="col-lg-12">
              {!! !empty($about->why_choose_us_description_1)?$about->why_choose_us_description_1:''!!}
         </div>

         <div class="col-lg-12">
            <div class="wcu-card-div">
               @foreach ($why_us_content as $data)
                   <div class="wcu-card wow fadeInRight">
                  <div class="wcu-card-img">
                     <img src="{{!empty($data->content_image_path) && Storage::exists($data->content_image_path) ? url('/').Storage::url($data->content_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="{{!empty($data->content_image_path)?$data->content_image_path:''}}">
                  </div>
                  <div class="wcu-card-content">
                     <h6>{{!empty($data->content_title)?$data->content_title:''}}</h6>
                     <p> {!! !empty($data->content_description)?$data->content_description:'' !!} </p>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

         <div class="col-lg-12 mt-4">
           {!! !empty($about->why_choose_us_description_2)?$about->why_choose_us_description_2:''!!}
         </div>

      </div>
   </div>
</section>
<!-- Why Choose Us -->
@endsection

@section('script')

<script type="text/javascript">
   $("#navbar").removeClass("nav-page");
   $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
   $(".home_active").removeClass("active");
   $(".about_active").addClass("active");
   $(".aboutus-active").addClass("active");
</script>

@endsection