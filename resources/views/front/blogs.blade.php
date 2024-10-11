@extends('front.layout.layout')
@section('title','Blogs')
@section('content')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black blogs-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Blogs</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Blogs</li>
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
<section class="iq-blog-section ptb-20 amr-blogs">
    <div class="container">
        @if(count($blogs) > 0)
        <div class="row">
            @foreach ($blogs as $blog)
            <a href="{{url('blog/'.(!empty($blog->slug_url)?$blog->slug_url:'#'))}}">
                <div class="col-lg-4 col-md-6 qloud-space-bottom ">
                    <div class="iq-blog-box" style="border: 1px solid #0d1e679e;">
                        <div class="iq-blog-image clearfix">
                            {{-- <img src="{{!empty($blog->image_path) && (Storage::exists($blog->image_path)) ? url('/').Storage::url($blog->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-fluid" alt="unisaas-blog"> --}}
                            <ul class="iq-blogtag">
                                @php
                                $dateString = !empty($blog->published_on)?$blog->published_on:'';
                                $timestamp = strtotime($dateString);
                                $formattedDate = date('j F Y', $timestamp);
                                @endphp
                                <li><a href="javascript:void(0)">{{$formattedDate}}</a></li>
                            </ul>
                        </div>
                        <div class="iq-blog-detail">
                            <div class="iq-blog-meta">
                                <ul class="iq-postdate">
                                    <li class="list-inline-item">
                                        <span class="publisher">{{!empty($blog->auther)?$blog->auther:""}}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="blog-title">
                                <!-- <a href="{{url('blog-details/'.(!empty($blog->id)?$blog->id:''))}}">
                                    <h5 class="mb-3">{{!empty($blog->title)?$blog->title:""}}</h5>
                                </a> -->
                                <a href="{{url('blog/'.(!empty($blog->slug_url)?$blog->slug_url:'#'))}}">
                                    <h5 class="mb-3">{{!empty($blog->title)?$blog->title:""}}</h5>
                                </a>
                            </div>
                            <p class="">{{ substr(strip_tags(!empty($blog->description)?$blog->description:''), 0, 200) . '...'}}</p>
                            <div class="blog-button">
                                <!-- <a class="iq-btn-link" href="{{url('blog-details/'.(!empty($blog->id)?$blog->id:''))}}">Read More<i class="ml-2 ion-ios-arrow-right"></i></a> -->
                                <a class="iq-btn-link" href="{{url('blog/'.(!empty($blog->slug_url)?$blog->slug_url:'#'))}}">Read More<i class="ml-2 ion-ios-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
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
    $(".blogs-active").addClass("active");
</script>

@endsection