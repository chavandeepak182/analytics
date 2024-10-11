@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    
    <h3>User {{ $mailData['email'] }} is Subscribe Your News Letter</h3>
    <h4>User IP is {{ $mailData['ip_address'] }}</h4>

@endsection