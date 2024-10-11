@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    <div style="width: 100%; display: block; margin-bottom: 10px;">
        <div style="font-size: 25px;color: #000;font-weight: 900;">
            <p>Enquiry Coming Report and Blog</p>
        </div>
    </div>
    <div style="width: 100%; margin-bottom: 30px;">
        <div style="font-size: 16px; color: #000;">
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Report Name – </b><a href="{{ isset($mailData['report_url']) ? $mailData['report_url'] : '' }}" target="blank">{{$mailData['report_name']}}</a></p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Request Type – </b>{{$mailData['request_type']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Name – </b>{{$mailData['name']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Email – </b>{{$mailData['email']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Comapany Name – </b>{{isset($mailData['company_name']) ? $mailData['company_name'] : 'Null'}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Phone – </b>{{$mailData['phone']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>IP Address – </b>{{$mailData['ip_address']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Message – </b>{{$mailData['message']}}</p>

        </div>
    </div>
@endsection
