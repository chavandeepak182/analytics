@extends('front.layout.layout')

@section('title',!empty($privacy->meta_title)?$privacy->meta_title:'')

@section('meta_description',!empty($privacy->meta_keyword)?$privacy->meta_keyword:'')

@section('meta_keywords', !empty($privacy->meta_description)?$privacy->meta_description:'')

@section('content')
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black privacy-policy-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">{{!empty($privacy->heading)?$privacy->heading:""}}</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Privacy Policy</li>
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
    <img src="images/others/shape1.png" class="img-fluid shape-left" alt="QLOUD">
    <img src="images/others/shape1.png" class="img-fluid shape-right" alt="1">
    <div class="container">
        <div class="terms-of-use-page_content bg-white">
           {!!  !empty($privacy->description)?$privacy->description:"" !!}
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