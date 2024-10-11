@extends('front.layout.layout')
@section('content')
    <style>
        body{
            font-family: system-ui;
            margin: 0;
        }
        .page-wrapper{
            width: 100%;
            /* height: 100vh; */
            background: aliceblue;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .thankyou-header{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .thankyou-header h1 {
            margin-bottom: 0;
            font-size: 35px;
        }
        .thankyou-header h4 {
            font-size: 19px;
            text-align: center;
            margin: 30px 0;
            line-height: 35px;
        }
        .thankyou-header img{ 
            width: 55px;
        }
        .thankyou-footer {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .thankyou-footer a{
            font-weight: 600;
            text-decoration: none;
            /* color: #000; */
        }
        .thankyou-footer p{
            margin: 30px 0;
            font-size: 18px;
        }
        .thankyou-footer .btn.focus, .btn:focus{
           box-shadow: unset;
        }
        .thankyou-footer a.btn{
            background: #000;
            padding: 7px 20px;
            color: #fff;
            border-radius: 0;
        }
        .thankyou{
            padding: 40px;
            background: #fff;
            border-radius: 5px;
            /* width: 50%; */
            margin: 100px 0 30px;
            text-align: center;
        }
        .thankyou-body{
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .thankyou-body h4{
            color: #666;
            font-weight: 500;
            font-size: 18px;
            margin-top: 0;
        }
        .thankyou-body a{
            font-weight: 600;
            color: #1e92c7;
            text-decoration: none;
            font-size: 15px;
            
        }
        .email-link {
            color: #007bfc;
        }
    </style>

    <div class="page-wrapper">
        <div class="container">
            <div class="thankyou">
                <div class="thankyou-header">
                    <img src="{{URL::asset('front/images/sad.png')}}" alt="">
                    <h1>Sorry, Payment Failed!</h1>
                    <h4>
                        Please ensure that the billing address you provided is the same one where your debit/credit is registered. <br>
                        Alternatly, Please try a different payment method.
                    </h4>
                </div>
                <div class="thankyou-footer">
                    <a href="{{ url('/') }}" class="btn">Back to Home</a>
                    <p>Having trouble? <a href="{{ url('/contactus') }}" class="email-link">Submit a query</a> and we will get back to you.</p>
                </div>
            </div>
        </div>
    </div>

@endsection