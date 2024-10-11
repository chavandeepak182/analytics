<!-- Footer Start -->
<footer id="contact" class=" iq-over-dark-90">
     @php
        $contacts=App\Models\Arm_general_settings::where('status', '=', 'active')->first();
     @endphp
    <!-- Address -->
    <div class="footer-topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="widget">
                        <div class="textwidget">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
                                    <h2 class="text-white">Subscribe for Newsletter</h2>
                                </div>
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <form action="{{ url('/newsletter') }}" method="post" class="mc4wp-form mc4wp-form-517">
                                        @csrf
                                        <div class="mc4wp-form-fields">
                                            <input type="text" id="newsletter_email" name="newsletter_email" placeholder="Your email address">
                                            <input type="submit" value="Subscribe">
                                        </div>
                                    </form>
                                    @if($errors->has('newsletter_email'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('newsletter_email')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="widget">
                        <div class="textwidget ">
                            <a href="{{url('/')}}" class="pb-2">
                                @php
                                    $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('logo_image_path','logo_image_name')->first();
                                @endphp
                                <img src="{{ !empty($logo_image->logo_image_path) && Storage::exists($logo_image->logo_image_path) ? url('/').Storage::url($logo_image->logo_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" alt="{{ !empty($logo_image->logo_image_name) ? $logo_image->logo_image_name : 'Logo Image' }}" style="max-width: 160px; max-height: 160px;">
                                <!-- <img class="mb-4 img-fluid" src="{{URL::asset('front/images/we-logo.png')}}" alt="logo"> -->
                            </a>
                            <p class="mt-3">
                                The most trustworthy platform for veritable market research reports incorporated with in-depth industry insights
                            </p>
                            <div class="mt-3">
                                <ul class="footer-social">
                                    @if(!empty($contacts->twitter_url))
                                    <li class="d-inline"><a href="{{!empty($contacts->twitter_url)?$contacts->twitter_url:''}}"><i class="fa fa-twitter"></i></a></li>
                                    @endif
                                     @if(!empty($contacts->email))
                                    <li class="d-inline"> <a href="mailto:{{!empty($contacts->email)?$contacts->email:''}}"><i class="fa fa-envelope"></i></a></li>
                                     @endif
                                    @if(!empty($contacts->facebook_url))
                                    <li class="d-inline"><a href="{{!empty($contacts->facebook_url)?$contacts->facebook_url:""}}"><i class="fa fa-facebook"></i></a></li>
                                     @endif
                                    @if(!empty($contacts->instagram_url))
                                    <li class="d-inline"><a href="{{!empty($contacts->instagram_url)?$contacts->instagram_url:""}}"><i class="fa fa-instagram"></i></a></li>
                                     @endif
                                    @if(!empty($contacts->linkedin_url))
                                    <li class="d-inline"><a href="{{!empty($contacts->linkedin_url)?$contacts->linkedin_url:""}}"><i class="fa fa-linkedin"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-4 mt-lg-0 mt-md-0 ">
                    <div class="widget">
                        <h4 class="footer-title">Quick Menu</h4>
                        <div>
                            <ul class="menu">
                                <!-- <li><a href="index')}}" aria-current="page">Home</a></li> -->
                                <li><a href="{{url('aboutus')}}">About Us</a></li>
                                <li><a href="{{url('/research-reports/all')}}">Reports</a></li>
                                <li><a href="{{url('press-release')}}">Press Release</a></li>
                                <li><a href="{{url('services')}}">Services</a></li>
                                <li><a href="{{url('careers')}}">Careers</a></li>
                                <li><a href="{{url('blog')}}">Blogs</a></li>
                                <li><a href="{{url('contactus')}}">Contact Us</a></li>
                                {{-- <li><a href="#">GDPR</a></li> --}}
                                <li><a href="{{url('terms-of-use')}}">Terms of Use</a></li>
                                <li><a href="{{url('privacy-policy')}}">GDPR and Privacy Policy </a></li>
                                <!-- <li><a href="#">Sitemap</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 mt-lg-0 mt-4">
                    <div class="widget">
                        <h4 class="footer-title ">Contact Us</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="iq-contact">
                                    <li>
                                        <a><i class="fa fa-home"></i><span>
                                                <!-- <img src="{{URL::asset('front/images/new-images/homepage/usa-flag.png')}}" alt=""> -->
                                                {{-- UNITED STATES <br>
                                                99 WALL STREET, #2124 NEW YORK, <br>
                                                NY 10005 --}}
                                                {{!empty($contacts->address)? $contacts->address:''}}
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{!empty($contacts->email)?$contacts->email:''}}"><i class="fa fa-envelope"></i><span>{{!empty($contacts->email)?$contacts->email:''}}</span></a>
                                    </li>
                                    <li class="footer-phone">
                                        <a href="tel:{{!empty($contacts->mobile)?$contacts->mobile:''}}"><i class="fa fa-phone"></i><span>{{!empty($contacts->mobile)? $contacts->mobile:''}}</span></a>
                                        <!--<a href="tel:+1(929)-450-2887"><i-->
                                        <!--        class="fa fa-phone"></i><span>+1(929)-450-2887</span></a>-->
                                        <!--<a href="tel:+1(650)-666-4592"><i-->
                                        <!--        class="fa fa-phone"></i><span>+1(650)-666-4592</span></a>-->
                                    </li>
                                    {{-- @if(!empty($contacts->skype_url))
                                    <li>
                                        <a href="{{!empty($contacts->skype_url)?$contacts->skype_url:''}}"><i class="fa fa-skype"></i><span>{{!empty($contacts->skype_url)?$contacts->skype_url:''}}</span></a>
                                    </li>
                                    @endif --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 mt-lg-0 mt-4">
                    <div class="footer-official-pay">
                        <div class="widget">
                            <h4 class="footer-title ">Working Hours</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Our support available to help you 24 hours a day, five days a week.</p>
                                    <ul>
                                        <li class="d-inline">Saturday & Sunday :</li>
                                        <li class="d-inline">Closed</li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h4 class="footer-title ">Payment Mode</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="payment-mode-img">
                                        <img src="{{URL::asset('front/images/new-images/payment/stripe.png')}}" class="img-fluid" alt="client-img" />
                                        <img src="{{URL::asset('front/images/new-images/payment/paypal.png')}}" class="img-fluid" alt="client-img" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-12 mt-lg-0 mt-4">
                    <div class="widget payment-mode">
                        <h4 class="footer-title ">Payment Mode</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="my-carousel" class="owl-carousel" data-dots="false" data-nav="false" data-items="6" data-items-laptop="4" data-items-tab="4" data-items-mobile="2" data-items-mobile-sm="2" data-autoplay="true" data-loop="true" data-margin="40">
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/american-experts.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/master-card.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/paypal.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/stripe.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/visa.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="payment-mode-img">
                                            <img src="{{URL::asset('front/images/new-images/payment/wire-transfer.png')}}" class="img-fluid" alt="client-img" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Address END -->
    <div class="copyright-footer">
        <div class="container">
            <div class="pt-3 pb-3">
                <div class="row justify-content-between">
                    <!-- <div class="col-lg-6 col-md-12 text-lg-left text-md-center text-center">
                            <div class="social-icone">
                                <ul>
                                    <li class="d-inline"><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                    <li class="d-inline"><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                    <li class="d-inline"><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div> -->
                    <div class="col-lg-12 col-md-12 text-md-center text-center">
                        <span class="copyright">Copyright <script>
                                document.write(new Date().getFullYear());
                            </script> Analytics Market Research All Rights Reserved.</span>
                        <span class="designed-by">Designed By - <a href="https://www.mplussoft.com/" target="_blank" style="color: #ff412e;">Mplussoft</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@include('front.layout.notifications')
<!-- Footer End -->
<!-- back-to-top -->
<div id="back-to-top">
    <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
</div>

<!-- <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div> -->

<!-- back-to-top End -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('front/js/jquery-3.4.1.js')}}"></script>
<!-- jQuery  for scroll me js -->
<script src="{{asset('front/js/jquery-min.js')}}"></script>
<!-- popper  -->
<script src="{{asset('front/js/popper.min.js')}}"></script>
<!--  bootstrap -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<!-- Appear JavaScript -->
<script src="{{asset('front/js/appear.js')}}"></script>
<!-- Jquery-migrate JavaScript -->
<script src="{{asset('front/js/jquery-migrate.min.js')}}"></script>
<!-- Scripts JavaScript -->
<script src="{{asset('front/js/scripts.js')}}"></script>
<!-- countdownTimer JavaScript -->
<script src="{{asset('front/js/jQuery.countdownTimer.min.js')}}"></script>
<!-- Tox-progress JavaScript -->
<script src="{{asset('front/js/tox-progress.min.js')}}"></script>
<!-- Timeline JavaScript -->
<!-- <script src="{{asset('front/js/timeline.js')}}"></script> -->
<!-- Timeline min JavaScript -->
<script src="{{asset('front/js/timeline.min.js')}}"></script>
<!-- Slick JavaScript -->
<script src="{{asset('front/js/slick.min.js')}}"></script>
<!-- Popper JavaScript -->
<script src="{{asset('front/js/popper.min.js')}}"></script>
<!-- Owl.carousel JavaScript -->
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<!-- Countdown JavaScript -->
<script src="{{asset('front/js/countdown.js')}}"></script>
<!-- Jquery.countTo JavaScript -->
<script src="{{asset('front/js/jquery.countTo.js')}}"></script>
<!-- Magnific-popup JavaScript -->
<script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Isotope.pkgd.min JavaScript -->
<script src="{{asset('front/js/isotope.pkgd.min.js')}}"></script>
<!-- Wow JavaScript -->
<script src="{{asset('front/js/wow.min.js')}}"></script>
<!--  Custom JavaScript -->
<script src="{{asset('front/js/custom.js')}}"></script>

<script src="{{asset('front/js/swiper-bundle.min.js')}}"></script>

<script src="{{ URL::asset('admin_panel/js/jquery.toast.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{ URL::asset('admin_panel/js/validations/common/common.js')}}"></script>

<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=4ecff8a8-eac8-420c-b05e-7517bc35f172"> </script>

<!-- <script src="{{ URL::asset('front/js/snippet.js')}}"></script> -->

<!-- REVOLUTION JS FILES -->
<!-- <script src="revslider/js/revolution.tools.min.js"></script> -->
<!-- <script src="revslider/js/rs6.min.js"></script> -->

<!-- chatbot -->
<script>
    const chatButton = document.getElementById("chat-button");
    const chatContainer = document.getElementById("chatContainer");
    const minimizeButton = document.getElementById("minimize-button");
    const chatInput = document.getElementById("chat-input");
    const chatMessages = document.getElementById("conversation-group");
    const sendButton = document.getElementById("SentButton");

    if (chatButton) {
        chatButton.addEventListener("click", function() {
            if (chatContainer) {
                chatContainer.classList.add("open");
                chatButton.classList.add("clicked");
            }
        });
    }

    if (minimizeButton) {
        minimizeButton.addEventListener("click", function() {
            if (chatContainer) {
                chatContainer.classList.remove("open");
                chatButton.classList.remove("clicked");
            }
        });
    }

    function createMessage(message, isUser = true) {
        const newMessage = document.createElement('div');
        newMessage.classList.add(isUser ? 'sentText' : 'botText');
        newMessage.textContent = message;
        chatMessages.appendChild(newMessage);
        return newMessage;
    }

    function chatbotResponse() {
        const messages = ["Hello!", "How can I assist you?", "Let me know if you have any further questions"];
        const randomIndex = Math.floor(Math.random() * messages.length);
        const message = messages[randomIndex];
        const botMessage = createMessage(message, false);
        botMessage.scrollIntoView();
    }

    chatInput.addEventListener("input", function(event) {
        if (event.target.value) {
            sendButton.classList.add("svgsent");
        } else {
            sendButton.classList.remove("svgsent");
        }
    });

    chatInput.addEventListener("keypress", function(event) {
        if (event.keyCode === 13) {
            const message = chatInput.value;
            chatInput.value = "";
            const userMessage = createMessage(message);
            userMessage.scrollIntoView();
            setTimeout(chatbotResponse, 1000);
            sendButton.classList.add("svgsent");
        }
    });

    if (sendButton) {
        sendButton.addEventListener("click", function() {
            const message = chatInput.value;
            chatInput.value = "";
            const userMessage = createMessage(message);
            userMessage.scrollIntoView();
            setTimeout(chatbotResponse, 1000);
            sendButton.classList.add("svgsent");
        });
    }
</script>
<!-- chatbot -->

<!-- Toaster -->
<script>
  @if(Session::has('success'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }
  toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }
  toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }
  toastr.error("{{ session('warning') }}");
  @endif
</script>

<script>
  function success_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'success',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }

  function fail_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'error',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }

  function warning_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'warning',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }
</script>
<!-- Toaster -->

</body>

</html>