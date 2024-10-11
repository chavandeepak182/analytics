@extends('front.layout.layout')
@section('title','Payment')
@section('content')

<style>
  .payment-form .icon-box-content h6 {
font-size: 20px;
  }
  .para-type{
    font-size: 12px;
    margin: 10px 0 0;
    color: #0d1e67;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }
  .para-type span{
    color: #dc354585;
  }
     .country-code {
        float: left;
        width: 165px;
        height: 45px;
        padding: 0.55rem 0.375rem;
        font-size: 15px;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
        background: #fff;
    }
    .payment-form .icon-box-content {
        width: 100%;
    }
    .payment-form .icon-box-content h6 {
        margin-bottom: 10px;
    }

.payment-form .CaptchaWrap { 
    position: relative; 
}
.payment-form .CaptchaTxtField { 
  border-radius: 10px;
  border: 1px solid #ccc; 
  display: block;  
  box-sizing: border-box;
}

.d-flex-div{
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.payment-form #UserCaptchaCode { 
  padding: 15px 10px; 
  outline: none; 
  font-size: 18px; 
  font-weight: normal; 
  width: 100%;
}
.payment-form #CaptchaImageCode { 
  text-align:center;
  padding: 0px 0;
  overflow: hidden;
}

.payment-form .capcode { 
  display: block; 
  width: 162px;
  border-radius: 6px !important;
}
.payment-form .CaptchaDiv{ 
  display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}


.payment-form .ReloadBtn { 
  background-color : transparent;
  cursor: pointer;
}
.payment-form .ReloadBtn img { 
  width: 30px;
}
.payment-form .btnSubmit {
  margin-top: 15px;
  border: 0px;
  padding: 10px 20px; 
  border-radius: 5px;
  font-size: 18px;
  background-color: #1285c4;
  color: #fff;
  cursor: pointer;
}

.payment-form .error { 
  color: red; 
  font-size: 12px; 
  display: none; 
}
.payment-form .success {
  color: green;
  font-size: 18px;
  margin-bottom: 15px;
  display: none;
}
.payment-mode-page {
  padding: 30px 0;
}
</style>
<!-- Breadcrumb Start -->
<div class=" main-bg">
    <div class="container-fluid p-0">
        <div class="text-left iq-breadcrumb-one iq-bg-over black payment-mode-banner    ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                            <h2 class="title">Pay</h2>
                            <ol class="breadcrumb main-bg">
                                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Home </a></li>
                                <li class="breadcrumb-item active">Pay</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Iconbox Start -->
<section class="payment-mode-page">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-left" alt="QLOUD">
    <img src="{{URL::asset('front/images/others/shape1.png')}}" class="img-fluid shape-right" alt="1">
    <div class="container">
        <div class="payment-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-icon-box iq-icon-box-style-5 bg-white iq-box-shadow wow fadeInUp" data-wow-duration="0.7s" style="visibility: visible; animation-duration: 0.7s; animation-name: fadeInUp;">
                        <div class="icon-box-content">
                            <h6>Report Title:</h6>
                            <a href="{{ url('/reports/'.$report_details->url.'/'.$report_details->id) }}" class="icon-box-desc">{{ !empty($report_details->title) ? $report_details->title : '' }}</a>
                            <p class="para-type">Report Format: <span>PPT, PDF, WORD, EXCEL</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <form action="{{ route('pay') }}" method="post" class="form wow fadeInRight" data-wow-duration="0.7s" id="payment_form">
                    @csrf
                    <input type="hidden" name="id" value="{{ !empty($report_details->id) ? $report_details->id : '' }}">
                    <div class="row">
                      <div class="col-lg-5 col-md-5">
                        <div class="plans-detail mb-4  wow fadeInLeft"  data-wow-duration="0.7s">
                            <div class="plans-detail_header">
                                <h6>CHOOSE LICENSE TYPE</h6>
                            </div>
                            <div class="plans-detail_cards form-check">
                                <div class="plans-detail_card green container-tick form-check-label" for="exampleRadios1">
                                    <input class="form-check-input " type="radio" name="license" id="exampleRadios1" value="single">
                                    <label for="exampleRadios1" class="form-check-label tip">Single User Access - $ {{ !empty($report_details->single_user_cost) ? $report_details->single_user_cost : '' }}  </label>
                                </div>
                                <div class="plans-detail_card green form-check-label" for="exampleRadios2">
                                    <input class="form-check-input" type="radio" name="license" id="exampleRadios2" value="multi">
                                    <label for="exampleRadios2" class="form-check-label tip">Multi User Access - $ {{ !empty($report_details->multi_user_cost) ? $report_details->multi_user_cost : '' }} </label>
                                </div>
                                <div class="plans-detail_card green ">
                                    <input class="form-check-input" type="radio" name="license" id="exampleRadios3" value="enterp">
                                    <label for="exampleRadios3" class="form-check-label tip">Corporate Access - $ {{ !empty($report_details->enterprise_user_cost) ? $report_details->enterprise_user_cost : '' }} </label>
                                </div>
                            </div>
                            @if($errors->has('license'))
                                <span class="text-danger"><b>*</b> {{$errors->first('license')}}</span>
                            @endif
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-7">
                        <div class="form-internal-content">
                          <div class="payment-mode">
                              <p class="title">Secure Payment By :</p>
                              <div class="radio-inputs">
                                  <label>
                                      <input checked="" class="radio-input" type="radio" name="payment_method" value="stripe">
                                      <span class="radio-tile">
                                          <span class="radio-icon">
                                          <img src="{{URL::asset('front/images/new-images/payment/stripe.png')}}" alt="">
                                          </span>
                                          <span class="radio-label">Stripe</span>
                                      </span>
                                  </label>
                                  <label>
                                      <input class="radio-input" type="radio" name="payment_method" value="paypal">
                                      <span class="radio-tile">
                                          <span class="radio-icon">
                                              <img src="{{URL::asset('front/images/new-images/payment/paypal.png')}}" alt="">
                                          </span>
                                          <span class="radio-label">PayPal</span>
                                      </span>
                                  </label>
                              </div>
                              @if($errors->has('payment_method'))
                                  <span class="text-danger"><b>*</b> {{$errors->first('payment_method')}}</span>
                              @endif
                          </div>
                          <div class="payment-form-content">
                              <p class="title">Please register your details.</p>
                              <label>
                                  <input type="text" name="user_name" class="input" placeholder="" required>
                                  <span>Full Name</span>
                                  @if($errors->has('user_name'))
                                      <span class="text-danger"><b>*</b> {{$errors->first('user_name')}}</span>
                                  @endif
                              </label>
                                      
                              <label>
                                  <input type="email" name="user_email" class="input" placeholder="" required>
                                  <span>Email</span>
                                  @if($errors->has('user_email'))
                                      <span class="text-danger"><b>*</b> {{$errors->first('user_email')}}</span>
                                  @endif
                              </label> 

                              <div class="flex">
                                  <div class="form-group">
                                    <select name="country_code" id="buynow-country-code" class="country-code" class="purchase-form-inp">
                                        <option data-countrycode="US" value="1">USA (+1)</option>
                                        <option data-countrycode="GB" value="44">UK (+44)</option>
                                        <optgroup label="Other countries">
                                            <option data-countrycode="AF" value="93">Afghanistan (+93)</option>
                                            <option data-countrycode="AL" value="355">Albania (+355)</option>
                                            <option data-countrycode="DZ" value="213">Algeria (+213)</option>
                                            <option data-countrycode="AD" value="376">Andorra (+376)</option>
                                            <option data-countrycode="AO" value="244">Angola (+244)</option>
                                            <option data-countrycode="AI" value="1264">Anguilla (+1264)</option>
                                            <option data-countrycode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                            <option data-countrycode="AR" value="54">Argentina (+54)</option>
                                            <option data-countrycode="AM" value="374">Armenia (+374)</option>
                                            <option data-countrycode="AW" value="297">Aruba (+297)</option>
                                            <option data-countrycode="AU" value="61">Australia (+61)</option>
                                            <option data-countrycode="AT" value="43">Austria (+43)</option>
                                            <option data-countrycode="AZ" value="994">Azerbaijan (+994)</option>
                                            <option data-countrycode="BS" value="1242">Bahamas (+1242)</option>
                                            <option data-countrycode="BH" value="973">Bahrain (+973)</option>
                                            <option data-countrycode="BD" value="880">Bangladesh (+880)</option>
                                            <option data-countrycode="BB" value="1246">Barbados (+1246)</option>
                                            <option data-countrycode="BY" value="375">Belarus (+375)</option>
                                            <option data-countrycode="BE" value="32">Belgium (+32)</option>
                                            <option data-countrycode="BZ" value="501">Belize (+501)</option>
                                            <option data-countrycode="BJ" value="229">Benin (+229)</option>
                                            <option data-countrycode="BM" value="1441">Bermuda (+1441)</option>
                                            <option data-countrycode="BT" value="975">Bhutan (+975)</option>
                                            <option data-countrycode="BO" value="591">Bolivia (+591)</option>
                                            <option data-countrycode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                            <option data-countrycode="BW" value="267">Botswana (+267)</option>
                                            <option data-countrycode="BR" value="55">Brazil (+55)</option>
                                            <option data-countrycode="BN" value="673">Brunei (+673)</option>
                                            <option data-countrycode="BG" value="359">Bulgaria (+359)</option>
                                            <option data-countrycode="BF" value="226">Burkina Faso (+226)</option>
                                            <option data-countrycode="BI" value="257">Burundi (+257)</option>
                                            <option data-countrycode="KH" value="855">Cambodia (+855)</option>
                                            <option data-countrycode="CM" value="237">Cameroon (+237)</option>
                                            <option data-countrycode="CA" value="1">Canada (+1)</option>
                                            <option data-countrycode="CV" value="238">Cape Verde Islands (+238)</option>
                                            <option data-countrycode="KY" value="1345">Cayman Islands (+1345)</option>
                                            <option data-countrycode="CF" value="236">Central African Republic (+236)</option>
                                            <option data-countrycode="CL" value="56">Chile (+56)</option>
                                            <option data-countrycode="CN" value="86">China (+86)</option>
                                            <option data-countrycode="CO" value="57">Colombia (+57)</option>
                                            <option data-countrycode="KM" value="269">Comoros (+269)</option>
                                            <option data-countrycode="CG" value="242">Congo (+242)</option>
                                            <option data-countrycode="CK" value="682">Cook Islands (+682)</option>
                                            <option data-countrycode="CR" value="506">Costa Rica (+506)</option>
                                            <option data-countrycode="HR" value="385">Croatia (+385)</option>
                                            <option data-countrycode="CU" value="53">Cuba (+53)</option>
                                            <option data-countrycode="CY" value="90392">Cyprus North (+90392)</option>
                                            <option data-countrycode="CY" value="357">Cyprus South (+357)</option>
                                            <option data-countrycode="CZ" value="42">Czech Republic (+42)</option>
                                            <option data-countrycode="DK" value="45">Denmark (+45)</option>
                                            <option data-countrycode="DJ" value="253">Djibouti (+253)</option>
                                            <option data-countrycode="DM" value="1809">Dominica (+1809)</option>
                                            <option data-countrycode="DO" value="1809">Dominican Republic (+1809)</option>
                                            <option data-countrycode="EC" value="593">Ecuador (+593)</option>
                                            <option data-countrycode="EG" value="20">Egypt (+20)</option>
                                            <option data-countrycode="SV" value="503">El Salvador (+503)</option>
                                            <option data-countrycode="GQ" value="240">Equatorial Guinea (+240)</option>
                                            <option data-countrycode="ER" value="291">Eritrea (+291)</option>
                                            <option data-countrycode="EE" value="372">Estonia (+372)</option>
                                            <option data-countrycode="ET" value="251">Ethiopia (+251)</option>
                                            <option data-countrycode="FK" value="500">Falkland Islands (+500)</option>
                                            <option data-countrycode="FO" value="298">Faroe Islands (+298)</option>
                                            <option data-countrycode="FJ" value="679">Fiji (+679)</option>
                                            <option data-countrycode="FI" value="358">Finland (+358)</option>
                                            <option data-countrycode="FR" value="33">France (+33)</option>
                                            <option data-countrycode="GF" value="594">French Guiana (+594)</option>
                                            <option data-countrycode="PF" value="689">French Polynesia (+689)</option>
                                            <option data-countrycode="GA" value="241">Gabon (+241)</option>
                                            <option data-countrycode="GM" value="220">Gambia (+220)</option>
                                            <option data-countrycode="GE" value="7880">Georgia (+7880)</option>
                                            <option data-countrycode="DE" value="49">Germany (+49)</option>
                                            <option data-countrycode="GH" value="233">Ghana (+233)</option>
                                            <option data-countrycode="GI" value="350">Gibraltar (+350)</option>
                                            <option data-countrycode="GR" value="30">Greece (+30)</option>
                                            <option data-countrycode="GL" value="299">Greenland (+299)</option>
                                            <option data-countrycode="GD" value="1473">Grenada (+1473)</option>
                                            <option data-countrycode="GP" value="590">Guadeloupe (+590)</option>
                                            <option data-countrycode="GU" value="671">Guam (+671)</option>
                                            <option data-countrycode="GT" value="502">Guatemala (+502)</option>
                                            <option data-countrycode="GN" value="224">Guinea (+224)</option>
                                            <option data-countrycode="GW" value="245">Guinea - Bissau (+245)</option>
                                            <option data-countrycode="GY" value="592">Guyana (+592)</option>
                                            <option data-countrycode="HT" value="509">Haiti (+509)</option>
                                            <option data-countrycode="HN" value="504">Honduras (+504)</option>
                                            <option data-countrycode="HK" value="852">Hong Kong (+852)</option>
                                            <option data-countrycode="HU" value="36">Hungary (+36)</option>
                                            <option data-countrycode="IS" value="354">Iceland (+354)</option>
                                            <option data-countrycode="IN" value="91">India (+91)</option>
                                            <option data-countrycode="ID" value="62">Indonesia (+62)</option>
                                            <option data-countrycode="IR" value="98">Iran (+98)</option>
                                            <option data-countrycode="IQ" value="964">Iraq (+964)</option>
                                            <option data-countrycode="IE" value="353">Ireland (+353)</option>
                                            <option data-countrycode="IL" value="972">Israel (+972)</option>
                                            <option data-countrycode="IT" value="39">Italy (+39)</option>
                                            <option data-countrycode="JM" value="1876">Jamaica (+1876)</option>
                                            <option data-countrycode="JP" value="81">Japan (+81)</option>
                                            <option data-countrycode="JO" value="962">Jordan (+962)</option>
                                            <option data-countrycode="KZ" value="7">Kazakhstan (+7)</option>
                                            <option data-countrycode="KE" value="254">Kenya (+254)</option>
                                            <option data-countrycode="KI" value="686">Kiribati (+686)</option>
                                            <option data-countrycode="KP" value="850">Korea North (+850)</option>
                                            <option data-countrycode="KR" value="82">Korea South (+82)</option>
                                            <option data-countrycode="KW" value="965">Kuwait (+965)</option>
                                            <option data-countrycode="KG" value="996">Kyrgyzstan (+996)</option>
                                            <option data-countrycode="LA" value="856">Laos (+856)</option>
                                            <option data-countrycode="LV" value="371">Latvia (+371)</option>
                                            <option data-countrycode="LB" value="961">Lebanon (+961)</option>
                                            <option data-countrycode="LS" value="266">Lesotho (+266)</option>
                                            <option data-countrycode="LR" value="231">Liberia (+231)</option>
                                            <option data-countrycode="LY" value="218">Libya (+218)</option>
                                            <option data-countrycode="LI" value="417">Liechtenstein (+417)</option>
                                            <option data-countrycode="LT" value="370">Lithuania (+370)</option>
                                            <option data-countrycode="LU" value="352">Luxembourg (+352)</option>
                                            <option data-countrycode="MO" value="853">Macao (+853)</option>
                                            <option data-countrycode="MK" value="389">Macedonia (+389)</option>
                                            <option data-countrycode="MG" value="261">Madagascar (+261)</option>
                                            <option data-countrycode="MW" value="265">Malawi (+265)</option>
                                            <option data-countrycode="MY" value="60">Malaysia (+60)</option>
                                            <option data-countrycode="MV" value="960">Maldives (+960)</option>
                                            <option data-countrycode="ML" value="223">Mali (+223)</option>
                                            <option data-countrycode="MT" value="356">Malta (+356)</option>
                                            <option data-countrycode="MH" value="692">Marshall Islands (+692)</option>
                                            <option data-countrycode="MQ" value="596">Martinique (+596)</option>
                                            <option data-countrycode="MR" value="222">Mauritania (+222)</option>
                                            <option data-countrycode="YT" value="269">Mayotte (+269)</option>
                                            <option data-countrycode="MX" value="52">Mexico (+52)</option>
                                            <option data-countrycode="FM" value="691">Micronesia (+691)</option>
                                            <option data-countrycode="MD" value="373">Moldova (+373)</option>
                                            <option data-countrycode="MC" value="377">Monaco (+377)</option>
                                            <option data-countrycode="MN" value="976">Mongolia (+976)</option>
                                            <option data-countrycode="MS" value="1664">Montserrat (+1664)</option>
                                            <option data-countrycode="MA" value="212">Morocco (+212)</option>
                                            <option data-countrycode="MZ" value="258">Mozambique (+258)</option>
                                            <option data-countrycode="MN" value="95">Myanmar (+95)</option>
                                            <option data-countrycode="NA" value="264">Namibia (+264)</option>
                                            <option data-countrycode="NR" value="674">Nauru (+674)</option>
                                            <option data-countrycode="NP" value="977">Nepal (+977)</option>
                                            <option data-countrycode="NL" value="31">Netherlands (+31)</option>
                                            <option data-countrycode="NC" value="687">New Caledonia (+687)</option>
                                            <option data-countrycode="NZ" value="64">New Zealand (+64)</option>
                                            <option data-countrycode="NI" value="505">Nicaragua (+505)</option>
                                            <option data-countrycode="NE" value="227">Niger (+227)</option>
                                            <option data-countrycode="NG" value="234">Nigeria (+234)</option>
                                            <option data-countrycode="NU" value="683">Niue (+683)</option>
                                            <option data-countrycode="NF" value="672">Norfolk Islands (+672)</option>
                                            <option data-countrycode="NP" value="670">Northern Marianas (+670)</option>
                                            <option data-countrycode="NO" value="47">Norway (+47)</option>
                                            <option data-countrycode="OM" value="968">Oman (+968)</option>
                                            <option data-countrycode="PW" value="680">Palau (+680)</option>
                                            <option data-countrycode="PA" value="507">Panama (+507)</option>
                                            <option data-countrycode="PG" value="675">Papua New Guinea (+675)</option>
                                            <option data-countrycode="PY" value="595">Paraguay (+595)</option>
                                            <option data-countrycode="PE" value="51">Peru (+51)</option>
                                            <option data-countrycode="PH" value="63">Philippines (+63)</option>
                                            <option data-countrycode="PL" value="48">Poland (+48)</option>
                                            <option data-countrycode="PT" value="351">Portugal (+351)</option>
                                            <option data-countrycode="PR" value="1787">Puerto Rico (+1787)</option>
                                            <option data-countrycode="QA" value="974">Qatar (+974)</option>
                                            <option data-countrycode="RE" value="262">Reunion (+262)</option>
                                            <option data-countrycode="RO" value="40">Romania (+40)</option>
                                            <option data-countrycode="RU" value="7">Russia (+7)</option>
                                            <option data-countrycode="RW" value="250">Rwanda (+250)</option>
                                            <option data-countrycode="SM" value="378">San Marino (+378)</option>
                                            <option data-countrycode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                            <option data-countrycode="SA" value="966">Saudi Arabia (+966)</option>
                                            <option data-countrycode="SN" value="221">Senegal (+221)</option>
                                            <option data-countrycode="CS" value="381">Serbia (+381)</option>
                                            <option data-countrycode="SC" value="248">Seychelles (+248)</option>
                                            <option data-countrycode="SL" value="232">Sierra Leone (+232)</option>
                                            <option data-countrycode="SG" value="65">Singapore (+65)</option>
                                            <option data-countrycode="SK" value="421">Slovak Republic (+421)</option>
                                            <option data-countrycode="SI" value="386">Slovenia (+386)</option>
                                            <option data-countrycode="SB" value="677">Solomon Islands (+677)</option>
                                            <option data-countrycode="SO" value="252">Somalia (+252)</option>
                                            <option data-countrycode="ZA" value="27">South Africa (+27)</option>
                                            <option data-countrycode="ES" value="34">Spain (+34)</option>
                                            <option data-countrycode="LK" value="94">Sri Lanka (+94)</option>
                                            <option data-countrycode="SH" value="290">St. Helena (+290)</option>
                                            <option data-countrycode="KN" value="1869">St. Kitts (+1869)</option>
                                            <option data-countrycode="SC" value="1758">St. Lucia (+1758)</option>
                                            <option data-countrycode="SD" value="249">Sudan (+249)</option>
                                            <option data-countrycode="SR" value="597">Suriname (+597)</option>
                                            <option data-countrycode="SZ" value="268">Swaziland (+268)</option>
                                            <option data-countrycode="SE" value="46">Sweden (+46)</option>
                                            <option data-countrycode="CH" value="41">Switzerland (+41)</option>
                                            <option data-countrycode="SI" value="963">Syria (+963)</option>
                                            <option data-countrycode="TW" value="886">Taiwan (+886)</option>
                                            <option data-countrycode="TJ" value="7">Tajikstan (+7)</option>
                                            <option data-countrycode="TH" value="66">Thailand (+66)</option>
                                            <option data-countrycode="TG" value="228">Togo (+228)</option>
                                            <option data-countrycode="TO" value="676">Tonga (+676)</option>
                                            <option data-countrycode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                            <option data-countrycode="TN" value="216">Tunisia (+216)</option>
                                            <option data-countrycode="TR" value="90">Turkey (+90)</option>
                                            <option data-countrycode="TM" value="7">Turkmenistan (+7)</option>
                                            <option data-countrycode="TM" value="993">Turkmenistan (+993)</option>
                                            <option data-countrycode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                            <option data-countrycode="TV" value="688">Tuvalu (+688)</option>
                                            <option data-countrycode="UG" value="256">Uganda (+256)</option>
                                            <option data-countrycode="GB" value="44">UK (+44)</option>
                                            <option data-countrycode="UA" value="380">Ukraine (+380)</option>
                                            <option data-countrycode="AE" value="971">United Arab Emirates (+971)</option>
                                            <option data-countrycode="UY" value="598">Uruguay (+598)</option>
                                            <option data-countrycode="US" value="1">USA (+1)</option>
                                            <option data-countrycode="UZ" value="7">Uzbekistan (+7)</option>
                                            <option data-countrycode="VU" value="678">Vanuatu (+678)</option>
                                            <option data-countrycode="VA" value="379">Vatican City (+379)</option>
                                            <option data-countrycode="VE" value="58">Venezuela (+58)</option>
                                            <option data-countrycode="VN" value="84">Vietnam (+84)</option>
                                            <option data-countrycode="VG" value="84">Virgin Islands - British (+1284)</option>
                                            <option data-countrycode="VI" value="84">Virgin Islands - US (+1340)</option>
                                            <option data-countrycode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                            <option data-countrycode="YE" value="969">Yemen (North)(+969)</option>
                                            <option data-countrycode="YE" value="967">Yemen (South)(+967)</option>
                                            <option data-countrycode="ZM" value="260">Zambia (+260)</option>
                                            <option data-countrycode="ZW" value="263">Zimbabwe (+263)</option>
                                        </optgroup>
                                    </select>
                                    @if($errors->has('country_code'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('country_code')}}</span>
                                    @endif
                                  </div>

                                  <label>
                                      <input  type="text" name="user_mobile" class="input" placeholder="" required>
                                      <span>Number</span>
                                      @if($errors->has('user_mobile'))
                                          <span class="text-danger"><b>*</b> {{$errors->first('user_mobile')}}</span>
                                      @endif
                                  </label>

                              </div>

                              <fieldset>
                                  <span id="WrongCaptchaError" class="error"></span>
                                  <span class="text-success" id="SuccessMessage" class="error"></span>
                                  <div class="CaptchaDiv">
                                    <div class='CaptchaWrap'>
                                        <div id="CaptchaImageCode" class="CaptchaTxtField">
                                            <canvas id="CapCode" class="capcode" width="100" height="60px"></canvas>
                                        </div>
                                      </div>
                                      <div class="ReloadBtn" onclick='CreateCaptcha();' title="Reload Image">
                                          <img src="{{URL::asset('front/images/new-images/reports/recycle.png')}}" alt="" class="regenerate-img" >
                                      </div>
                                    <div class="d-flex-div">
                                      <label for="">
                                        <input type="text" id="UserCaptchaCode" class="CaptchaTxtField input" placeholder=''>
                                        <span>Enter Captcha</span>
                                      </label>
                                    </div>
                                  </div>
                              </fieldset>
                                      
                              <button type="button" class="Btn-pay" onclick="CheckCaptcha();">
                                  Pay
                                  <svg class="svgIcon-pay" viewBox="0 0 576 512"><path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
                              </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- </div> -->
                  </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Iconbox End -->


@endsection
@section('script')

<script type="text/javascript">
    $("#navbar").removeClass("nav-page");
    $("#navbar").addClass("banner-page-nav");
</script>
<script type="text/javascript">
    $(".home_active").removeClass("active");
    $(".payment_active").addClass("active");
</script>

<script>
    var cd;

  $(function(){
    CreateCaptcha();
  });

  // Create Captcha
  function CreateCaptcha() {
    //$('#InvalidCapthcaError').hide();
    var alpha = new Array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');                
    var i;
    for (i = 0; i < 4; i++) {
      var a = alpha[Math.floor(Math.random() * alpha.length)];
      var b = alpha[Math.floor(Math.random() * alpha.length)];
      var c = alpha[Math.floor(Math.random() * alpha.length)];
      var d = alpha[Math.floor(Math.random() * alpha.length)];
      // var e = alpha[Math.floor(Math.random() * alpha.length)];
      // var f = alpha[Math.floor(Math.random() * alpha.length)];
    }
    cd = a + ' ' + b + ' ' + c + ' ' + d;
    $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')
    
    var c = document.getElementById("CapCode"),
        ctx=c.getContext("2d"),
        x = c.width / 2,
        img = new Image();

    img.src = "{{asset('front/images/white-curved.jpg')}}";
    img.onload = function () {
        var pattern = ctx.createPattern(img, "repeat");
        ctx.globalAlpha = "0.7";
        ctx.fillStyle = pattern;
        ctx.fillRect(0, 0, c.width, c.height);
        ctx.font="52px Roboto";
        ctx.fillStyle = 'White';
        ctx.textAlign = 'center';
        ctx.setTransform (1, -0.12, 0, 1, 0, 15);
        ctx.fillText(cd,x,55);
    };
    
  }

  //
  function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
    if (typeof stroke === 'undefined') {
      stroke = true;
    }
    if (typeof radius === 'undefined') {
      radius = 5;
    }
    if (typeof radius === 'number') {
      radius = {tl: radius, tr: radius, br: radius, bl: radius};
    } else {
      var defaultRadius = {tl: 0, tr: 0, br: 0, bl: 0};
      for (var side in defaultRadius) {
        radius[side] = radius[side] || defaultRadius[side];
      }
    }
    ctx.beginPath();
    ctx.moveTo(x + radius.tl, y);
    ctx.lineTo(x + width - radius.tr, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius.tr);
    ctx.lineTo(x + width, y + height - radius.br);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius.br, y + height);
    ctx.lineTo(x + radius.bl, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius.bl);
    ctx.lineTo(x, y + radius.tl);
    ctx.quadraticCurveTo(x, y, x + radius.tl, y);
    ctx.closePath();
    if (fill) {
      ctx.fill();
    }
    if (stroke) {
      ctx.stroke();
    }

  }

  // Validate Captcha
  function ValidateCaptcha() {
    var string1 = removeSpaces(cd);
    var string2 = removeSpaces($('#UserCaptchaCode').val());
    if (string1 == string2) {
      return true;
    }
    else {
      return false;
    }
  }

  // Remove Spaces
  function removeSpaces(string) {
    return string.split(' ').join('');
  }

  // Check Captcha
  function CheckCaptcha() {
    var result = ValidateCaptcha();
    if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
      $('#WrongCaptchaError').text('Please enter code given below in a picture.').show();
      $('#UserCaptchaCode').focus();
    } else {
      if(result == false) { 
        $('#WrongCaptchaError').text('Invalid Captcha! Please try again.').show();
        CreateCaptcha();
        $('#UserCaptchaCode').focus().select();
      }
      else { 
        $('#UserCaptchaCode').val('').attr('place-holder','Enter Captcha - Case Sensitive');
        CreateCaptcha();
        $('#WrongCaptchaError').fadeOut(100);
        $('#SuccessMessage').text('Capcha Mached, Please Wait...').show();
        $('#SuccessMessage').fadeIn(100).css('display','block').delay(10000).fadeOut(250);
        $("#payment_form").submit()
      }
    }  
  }
</script>

<script>
  $(document).ready(function(){
    var selected_license_type = "{{ !empty($license) ? $license : '' }}";
    $("input[name='license']").each(function(){
      if($(this).val() == selected_license_type){
        $(this).attr("checked",true);
      }
    })
  })
</script>

@endsection