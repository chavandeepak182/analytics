@extends('front.layout.layout')
@section('title','Payment Successful')
@section('content')
<!-- Blog Start -->
<section class="iq-blog-section payment-successful">
    <div class="container">
        <div class="payment-success-content">
            <div class="payment-header">
                <img src="{{asset('front/images/new-images/payment/congratulations.gif')}}" alt="">
                <h1 class="payment-title-1">Congratulations</h1>
                <h5 class="payment-title-2">Payment Successful !</h5>
            </div>
            <div class="payment-transaction">
                <div class="trans-id">
                    Transaction ID :  
                    <span>{{ $payment_id }}</span>
                </div>
                <div class="trans-id">
                    Amount :  
                    <span> ${{ $report_price }} </span>
                </div>
            </div>
            <div class="payment-footer">
                <p>Email has been sent...</p>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')


@endsection