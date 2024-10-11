
@extends('front.layout.layout')
@section('title','Infographics')
@section('content')

<style>
.infographics
{
    /* width: inherit !important; */
    margin:auto;
}
</style>

<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black infographics-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Infographics</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Infographics</li>
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
<div class="iq-blog-section overview-block-ptb infographics ptb-70">
    <div class="container">
        <div class="row">
            <hr style="margin: 10px 0 30px 0">
            <div class="row infographics">
                @if(count($infographics) > 0)
                    @foreach ($infographics as $infoData )
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="{{url('infographics-details/'.(!empty($infoData->id)?$infoData->id:''))}}">
                                <img src="{{!empty($infoData->image_path) && Storage::exists($infoData->image_path) ? url('/').Storage::url($infoData->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png')}}" alt="{{ !empty($infoData->image_name)?$infoData->image_name:'' }}">
                                <div class="content">
                                    <p class="title">{{!empty($infoData->title)?$infoData->title:''}}</p>
                                    <p class="title title-2">Read More</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-12 mt-4">
                        {{ $infographics->links() }}
                    </div>
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