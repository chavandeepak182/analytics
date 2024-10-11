@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    <h3>Dear {{ $mailData[0]['user_name'] }}</h3>
    <p>Thank you for Purchasing Our Product <a href="{{ url('/reports/'.$mailData[0]['report_slug'].'/'.$mailData[0]['report_id']) }}">{{ $mailData[0]['report_name'] }}.</a></p>
    <p>We have received your Payment of {{ $mailData[0]['report_price'] }} USD</p>
    <p>Your Transaction Id is {{ $mailData[0]['payment_id'] }}</p>
@endsection