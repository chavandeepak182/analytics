@extends('front.layout.layout')

@section('title',!empty($infographics->meta_title)?$infographics->meta_title:'')

@section('meta_description',!empty($infographics->meta_keyword)?$infographics->meta_keyword:'')

@section('meta_keywords', !empty($infographics->meta_description)?$infographics->meta_description:'')

@section('content')
<style>
    .sticky-form {
        position: static;
    }

    .sticky-form.fixedElement {
        width: 370px;
    }
</style>
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black blog-details-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">{{!empty($infographics->title)?$infographics->title:''}}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Infographics View</li>
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
<div class="iq-blog-section infographics-details iq-ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 mt-lg-0">
                    <div class="iq-blog-box">
                        <div class="iq-blog-image clearfix">
                            <img src="{{!empty($infographics->image_path) && Storage::exists($infographics->image_path) ? url('/').Storage::url($infographics->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid" alt="qloud" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 mt-lg-0">
                    <div class="right-side-div">
                        @if(!empty($report))
                        <div class="more-btns">
                            <div class="read-more-btn wow fadeInUp" data-wow-duration="1s">
                                <a class="fancy" href="{{ url('/reports'.'/'.$report->url.'/'.$report->id) }}">
                                    <span class="top-key"></span>
                                    <span class="text">View Report</span>
                                    <span class="bottom-key-1"></span>
                                    <span class="bottom-key-2"></span>
                                </a>
                            </div>
                            <div class="read-more-btn wow fadeInUp" data-wow-duration="1s">
                                <a class="fancy" href="{{url('/purchase'.'/'.$report->url.'/'.$report->id.'?license=single')}}">
                                    <span class="top-key"></span>
                                    <span class="text">Buy Report</span>
                                    <span class="bottom-key-1"></span>
                                    <span class="bottom-key-2"></span>
                                </a>
                            </div>
                        </div>    
                        @endif
                        <div class="recent-blogs">
                            <div class="recent-blogs_heading">
                                <h6>Recent Infographics</h6>
                            </div>
                            
                            @foreach ($recentInfographics as $infographicsData )
                               <a href="{{url('infographics-details/'.(!empty($infographicsData->id)?$infographicsData->id:''))}}">
                                <div class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="icon-box-img">
                                        <img src="{{!empty($infographicsData->image_path) && Storage::exists($infographicsData->image_path) ? url('/').Storage::url($infographicsData->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="w-100 img-fluid" alt="qloud">
                                    </div>
                                </div>
                            </a>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- #row -->
    </div>
</div>

@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".media_active").addClass("active");
    $(".infographics-active").addClass("active");
</script>

@endsection