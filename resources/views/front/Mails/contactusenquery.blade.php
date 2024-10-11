@extends('front.layout.mail_layout')

@section('email_css')
    
@endsection

@section('email_content')
    <div style="width: 100%; display: block; margin-bottom: 10px;">
        <div style="font-size: 25px;color: #000;font-weight: 900;">
            <p>Enquiry Coming from Contact Us</p>
        </div>
    </div>
    <div style="width: 100%; margin-bottom: 30px;">
        <div style="font-size: 16px; color: #000;">
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Name –</b>{{ $mailData['name'] }}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Email –</b>{{ $mailData['email'] }}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Phone –</b>{{ $mailData['phone'] }}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Company –</b> {{$mailData['company_name']}}</p>
            <p style="margin-bottom: 0px;margin-top: 5px;"><b>Message –</b>{{ $mailData['message'] }}</p>

        </div>
    </div>
    
@endsection

{{--<!DOCTYPE html>
<html>

<head>
    <title>Welcome We Market Research</title>
    <meta content="width=device-width" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
</head>
<style type="text/css">
    body {
        font-family: 'Poppins', sans-serif;
        color: #444444;
    }
</style>

<body style="background: #f1f1f1; margin: 0px auto; padding: 0px;font-family: 'Poppins', sans-serif;">
    <div style="background-color: #fff; margin: 0px auto; max-width: 800px; height: auto;overflow: hidden;">
        <div style="width: 100%;padding: 10px 40px;background: #3284f547;">
            <img src="{{asset('front/images/we-logo-1.png') }}" alt="We Market Research" width="180px">
        </div>

        <div style="width: 100%; display: block;">
            
        </div>
        <div class="" style="padding: 40px 40px 3px;">
            <div style="width: 100%; display: block; margin-bottom: 10px;">
                <div style="font-size: 25px;color: #000;font-weight: 900;">
                    <p>Enquiry Coming from Contact Us</p>
                </div>
            </div>
            <div style="width: 100%; margin-bottom: 30px;">
                <div style="font-size: 16px; color: #000;">
                    <p style="margin-bottom: 0px;margin-top: 5px;"><b>Name –</b>{{ $mailData['fname'].' '. $mailData['lname'] }}</p>
                    <p style="margin-bottom: 0px;margin-top: 5px;"><b>Email –</b>{{ $mailData['email'] }}</p>
                    <p style="margin-bottom: 0px;margin-top: 5px;"><b>Phone –</b>{{ $mailData['phone'] }}</p>
                    <p style="margin-bottom: 0px;margin-top: 5px;"><b>Company –</b> {{$mailData['company_name']}}</p>
                    <p style="margin-bottom: 0px;margin-top: 5px;"><b>Message –</b>{{ $mailData['message'] }}</p>

                </div>
            </div>
        </div>
        <div style="width: 100%;background: #3284f547;background-repeat: no-repeat;height: 20px;">
            <table width="100%" style="padding: 0 40px;">
                <thead>
                    <tr>
                        <th width="60%">
                            <p style="text-align:start;">View more relevant Reports.</p>
                        </th>
                        <th width="20%">
                        <a href="#" style="padding: 8px 20px;background: #27aae1;color: #fff;border-radius: 30px;text-decoration: none;">
                            Open Report
                        </a>
                        </th>
                        <th width="20%">
                            <a href="https://wemarketresearch.com/" target="_blank" style="padding: 8px 20px;background: #27aae1;color: #fff;border-radius: 30px;text-decoration: none;">
                                Visit Site
                            </a>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    </div>
    </div>

</body>

</html>--}}
