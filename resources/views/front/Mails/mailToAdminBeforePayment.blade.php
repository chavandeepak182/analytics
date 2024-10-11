@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    
    <h3>User {{ $mailData['user_name'] }} is going To buy Your Report</h3>
    <p>Report is: <a href="{{ url('/reports/'.$mailData['report_slug'].'/'.$mailData['report_id']) }}">{{ $mailData['report_name'] }}.</a>  Our Bussiness Development Expert will Circle back with requested details.</p>
    <p>Report Price: {{ $mailData['report_price'] }}</p>
    <p>Payment Method: {{ $mailData['payment_method'] }}</p>
    <p>License Type : {{ $mailData['license_type'] }}</p>
    <p>User Name :{{ $mailData['user_name'] }}</p>
    <p>User Email : <a href="mailto:{{ $mailData['user_email'] }}"></a>{{ $mailData['user_email'] }}</p>
    <p>User Mobile : <a href="tel:{{ $mailData['user_mobile'] }}"></a>{{ $mailData['user_mobile'] }}</p>

@endsection