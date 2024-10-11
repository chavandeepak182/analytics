@extends('front.layout.layout')

@section('title',!empty($terms_we_use->meta_title)?$terms_we_use->meta_title:'')

@section('meta_description',!empty($terms_we_use->meta_keyword)?$terms_we_use->meta_keyword:'')

@section('meta_keywords', !empty($terms_we_use->meta_description)?$terms_we_use->meta_description:'')

@section('content')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black terms-of-use-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">
                                {{!empty($terms_we_use->heading)?$terms_we_use->heading:''}}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">{{!empty($terms_we_use->heading)?$terms_we_use->heading:''}}</li>
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
<section class="terms-of-use-page">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-left" alt="QLOUD">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-right" alt="1">
    <div class="container">
        <div class="terms-of-use-page_content bg-white">
            {!! !empty($terms_we_use->description)?$terms_we_use->description:'' !!}
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
    $(".terms_of_use_active").addClass("active");
</script>

@endsection