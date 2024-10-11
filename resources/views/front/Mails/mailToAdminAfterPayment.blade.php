@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')

    <h3>User {{ $mailData[0]['user_name'] }} has Successfully buy Your Report <a href="{{ url('/reports/'.$mailData[0]['report_slug'].'/'.$mailData[0]['report_id']) }}">{{ $mailData[0]['report_name'] }}.</a></h3>
    <p>Payment of {{ $mailData[0]['report_price'] }} USD</p>
    <p>Transaction Id is {{ $mailData[0]['payment_id'] }}</p>
    
@endsection