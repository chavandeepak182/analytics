@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')

    <div style="width: 100%; display: block; margin-bottom: 10px;">
        <div style="font-size: 25px;color: #000;font-weight: 900;">
            <p>Analytics Market Research Enquiry</p>
        </div>
    </div>
    <div style="width: 100%; margin-bottom: 30px;">
        <div style="font-size: 16px; color: #000;">
            <p style="margin-bottom: 0px;margin-top: 5px;">Hello ! {{$mailData['name']}},</p>
            <p style="margin-bottom: 0px;margin-top: 5px;">Thank you for connecting with Analytics Market Research. Your enquiry is valuable to us, and we'll be addressing it promptly.</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><a href="{{ isset($mailData['report_url']) ? $mailData['report_url'] : '' }}">{{ isset($mailData['report_name']) ? $mailData['report_name'] : '' }}</a></p>
        </div>
    </div>

@endsection




