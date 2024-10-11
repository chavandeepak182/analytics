@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    <h1>Analytics Market <span class="staticColor">Research Reports</span> </h1>
    <div class="contentBox">
        <h3>Some One try for payment but payment is cancelled due to some issues</h3>
        <p>Report Name : <a href="{{ url('/reports/'.$mailData[0]['report_slug'].'/'.$mailData[0]['report_id']) }}">{{ $mailData[0]['report_name'] }}.</a></p>
        <p>Report Price: {{ $mailData[0]['report_price'] }}</p>
        <p>Payment Method: {{ $mailData[0]['payment_method'] }}</p>
        <p>License Type : {{ $mailData[0]['license_type'] }}</p>
        <p>User Name : {{ $mailData[0]['user_name'] }}</p>
        <p>User Email : <a href="mailto:{{ $mailData[0]['user_email'] }}"></a>{{ $mailData[0]['user_email'] }}</p>
        <p>User Mobile : <a href="tel:{{ $mailData[0]['user_mobile'] }}"></a>{{ $mailData[0]['user_mobile'] }}</p>
    </div>
    
@endsection