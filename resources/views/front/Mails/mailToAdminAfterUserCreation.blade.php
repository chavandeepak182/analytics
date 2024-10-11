@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')

    <h1>Analytics Market <span class="staticColor">Research Reports</span> </h1>
    <h3>You have created New User For The Role of {{ $mailData['role'] }}</h3>
    
@endsection