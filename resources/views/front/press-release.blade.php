@extends('front.layout.layout')
@section('title','Press Release')
@section('content')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black press-release-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Press Release</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Press Release</li>
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
<section class="iq-blog-section iq-pb-55 press-release ptb-70">
    <div class="container">
        <div class="container-inner">
            <div class="press-release-content">
                <div class="row">
                    @if(count($pressReleases) > 0) 
                        @foreach ($pressReleases as $pressData)
                            <div class="col-md-4 wow fadeInUp mb-5" data-wow-duration="0.8s">
                                <div class="acc-card">
                                    <div class="date-time-container">
                                        @php
                                            $dateString = !empty($pressData->published_on)?$pressData->published_on:'';
                                            $timestamp = strtotime($dateString);
                                            $formattedYear = date(' Y', $timestamp);
                                            $formattedDate = date('j F ', $timestamp);
                                        @endphp
                                        <div class="date-time" datetime="{{!empty($pressData->published_on)?$pressData->published_on:''}}">
                                            <span>{{$formattedDate}}</span>
                                            <span class="separator"></span>
                                            <span>{{$formattedYear}}</span>
                                        </div>
                                    </div>
                                    <div class="acc-card_content">
                                        <div class="acc-card_infos">
                                            {{-- <div class="press-list-img">
                                                <img src="{{!empty($pressData->image_path) && Storage::exists($pressData->image_path) ? url('/').Storage::url($pressData->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" class="img-fluid w-100 press-release-list-img" alt="Forbes">
                                            </div> --}}
                                            <a href="{{url('press-release/'.(!empty($pressData->slug_url)?$pressData->slug_url:'#'))}}">
                                                <span class="acc-card_title">
                                                    {{!empty($pressData->title)?$pressData->title:''}}
                                                </span>
                                            </a>

                                            <p class="acc-card_description">
                                                {{ substr(strip_tags(!empty($pressData->description)?$pressData->description:''), 0, 100) . '...' }}
                                            </p>
                                        </div>

                                        <a class="acc-card_action" href="{{url('press-release/'.(!empty($pressData->slug_url)?$pressData->slug_url:'#'))}}">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center align-items-center w-100">
                                <img src="{{ URL::asset('admin_panel/commonarea/dist/img/no-record-found.png') }}" class="no-data-found-img" alt="" width="400">
                            </div>
                        </div>
                    @endif

                </div>
            </div>
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
    $(".media_active").addClass("active");
    $(".press-release-active").addClass("active");
</script>

<script>
$(document).on("click", ".press-release", function (){
    var year = $(this).data("year");

         $.ajax({
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { year: year},
            url: base_url + "/press-release-data-show",
            success: function (response) {
                 //alert(response.data.heading);
                 //$('.modal-job-title').html(response.data.heading);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    
});  
</script>  
@endsection