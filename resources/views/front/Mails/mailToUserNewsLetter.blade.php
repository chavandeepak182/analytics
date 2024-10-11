@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')

    <div style="width: 100%; display: block; margin-bottom: 10px;">
        <div style="font-size: 25px;color: #000;font-weight: 900;">
            <p>Analytics Market Research News Letter</p>
        </div>
    </div>
    <div style="width: 100%; margin-bottom: 30px;">
        <div style="font-size: 16px; color: #000;">
            <p style="margin-bottom: 0px;margin-top: 5px;">Hello ! {{$mailData['email']}},</p>
            <p style="margin-bottom: 0px;margin-top: 5px;">Thank you for Subscribe News Letter of Analytics Market Research. Your enquiry is valuable to us, and we'll be addressing it promptly.</p>
        </div>
    </div>

@endsection