<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
    	@section('title')
        | Welcome to Josh Frontend
        @show
    </title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/custom.css') }}">
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
    <!-- Header Start -->
    <header>
        <!-- Icon Section Start -->
        <div class="icon-section">
            <div class="container">
                <ul class="list-inline">
                    <li>
                        <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li class="pull-right">
                        <ul class="list-inline icon-position">
                            <li>
                                <a href="mailto:"><i class="livicon" data-name="mail" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                <label class="hidden-xs"><a href="mailto:" class="text-white">info@americanvisaservices.net</a></label>
                            </li>
                            <li>
                                <a href="tel:"><i class="livicon" data-name="phone" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                <label class="hidden-xs"><a href="tel:" class="text-white">+1 201-880-7150</a></label>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //Icon Section End -->
        <!-- Nav bar Start -->
        <nav class="navbar navbar-default container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span><a href="#">_<i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                    </a></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" class="logo_position">
                    <img src="{{ asset('assets/images/avslogobrand.jpg') }}" alt="YOUR GATE TO THE WORLD" class="logo_position">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li {!! (Request::is('/') ? 'class="active"' : '') !!}><a href="{{ route('home') }}"> Home</a>
                    </li>
                    <li {!! (Request::is('track') ? 'class="active"' : '') !!}><a href="{{ URL::to('track') }}">Track Order</a>
                    </li>
                    <li {!! (Request::is('blog') || Request::is('blogitem/*') ? 'class="active"' : '') !!}><a href="{{ URL::to('blog') }}"> Blog</a>
                    </li>
                    <li {!! (Request::is('contact') ? 'class="active"' : '') !!}><a href="{{ URL::to('contact') }}">Contact</a>
                    </li>
                    {{--based on anyone login or not display menu items--}}
                    @if(Sentinel::guest())
                        <li><a href="{{ URL::to('login') }}">Login</a>
                        </li>
                        <li><a href="{{ URL::to('register') }}">Register</a>
                        </li>
                    @else
                        <li class="dropdown-toggle {{ (Request::is('my-account') ? 'active' : '') }}">
                            <a href="#" data-toggle="dropdown">My Account</a>
                           <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ URL::to('my-account') }}">Profile</a>
                                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Nav bar End -->
    </header>
    <!-- //Header End -->

    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer>
        <div class="container footer-text">
            <!-- About Us Section Start -->
            <div class="col-sm-4">
                <h4>About Us</h4>
                <p>
                    American Visa Services is your ultimate one stop for visa expdition. We help you by cutting down on all waiting times at embassy or consular offices. Get started fast and secured
                </p>
                <h4>Follow Us</h4>
                <ul class="list-inline">
                    <li>
                        <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //About us Section End -->
            <!-- Contact Section Start -->
            <div class="col-sm-4">
                <h4>Contact Us</h4>
                <ul class="list-unstyled">
                    <li>411 Hackensak Ave, Suite 201</li>
                    <li>Hackensack, NJ 07601</li>
                    <li><i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>Phone: +1 201-880-7150</li>
                    <li><i class="livicon icon4 icon3" data-name="printer" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Fax:+1 201-880-6147</li>
                    <li><i class="livicon icon3" data-name="mail-alt" data-size="20" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Email:<span class="text-success">info@americanvisaservices.net</span>
                    </li>
                    <li><i class="livicon icon4 icon3" data-name="skype" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Skype:
                        <span class="text-success">americanvisaservices</span>
                    </li>
                </ul>
            </div>
            <!-- //Contact Section End -->
            <!-- Recent post Section Start -->
            <div class="col-sm-4">
                <div class="news">
                    <h4>News letter</h4>
                    <p>subscribe to our newsletter and stay up to date with the latest news and deals</p>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="yourmail@mail.com" aria-describedby="basic-addon2">
                        <a href="#" class="btn btn-primary text-white" role="button">Subscribe</a>
                    </div>
                </div>
            </div>
            <!-- //Recent Post Section End -->
        </div>
    </footer>
    <!-- //Footer Section End -->
    <div class="copyright">
        <div class="container">
        <p>
            Copyright &copy;  American Visa Services, 2015
            <a href="#" data-toggle="modal" data-target="#privacyModal">Privacy Policy</a> |
            <a href="javascript:;" data-toggle="modal" data-target="#termsModal">Terms of Service</a>
        </p>
        <!-- Terms Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="termsModalLabel">Terms of Service</h4>
                    </div>
                    <div class="modal-body">
                          <p>I hereby authorize Americanvisaservices.net to submit my travel visa application to the appropriate travel visa consulate and to accept delivery of the travel visa on my behalf.
                          I understand that a travel itinerary is required to use an expediting service. If a travel itinerary can not be provided, the Department of State may accept a letter from a business stating you are traveling on business if the trip is business related.</p>
                          <p>Americanvisaservices.net is not responsible for any delays or errors caused by mail couriers such as FedEx, UPS or any other commercial carrier. Likewise, we are also not responsible for any delays resulting from errors or omissions in information provided to us by a travel visa applicant. Applicants are responsible for the completeness of all application material.</p>
                          <p>Your acknowledgement of the terms and conditions herein signifies that you understand the following:</p>
                          <p>We act as your limited agent for the limited purpose of submitting and facilitating your application through a courier("Agent"); we cannot accept responsibility for delays in or loss of any document(s) by any party not directly under our control, including, but not limited to, Travel Agents, Consulates, Embassies, travel visa Offices, or any other Entities or any delivery-service involved in handling documents. You understand that you are paying an additional fee to this company and that you are still responsible for government fees which will be paid directly to the United States travel visa Agency.</p>
                          <p>We help you submit &amp; retrieve your travel visa or other travel documents as your authorized Agent, in a timely manner. We do not issue your travel visa or other travel documents.</p>
                          <p>We have no control over the decisions made by Issuing Authorities regarding denial or approval of any travel visa or travel document or additional supporting documents and/or additional supporting requirements based upon the information submitted by you whether directly or through us as your agent. We have no control over the substance and/or completeness of your applications and statements therein that may affect the decision to either approve or deny your travel visa or other travel documents. You understand that you are solely responsible for completeness and accuracy of the information submitted to any Agency for issuance of any travel visa or travel document. We reserve the right to refuse service to any customer upon our suspicion or belief that information may be inaccurate, incomplete or otherwise deficient. Such refusal of service is at our sole discretion. Our maximum liability for Refusal of service is limited to the amount of fee paid to and collected by us from you under all circumstances, without limitation.</p>
                          <p>We have no control over official requirements of any issuing agency. Requirements for issuance of travel documents can and do change often. We cannot be held responsible for changes in official requirements whether mandatory or subjective. We will attempt to notify you of any such changes as they become available.</p>
                          <p>Americanvisaservices.net its owners, agents and affiliates can not provide any guaranties express or implied. Liability is limited to fees paid.</p>
                          <p>If your required documentation and/or supporting documentation is not received by us in the specified time period (typically 3 business days, but sooner depending upon service requested or required) additional charges may be incurred by you to facilitate service to provide a travel visa or other travel document by the departure date listed by you in your order form. We cannot guarantee that even with additional fees or charges that such documents will be provided by your listed departure date when you're your required documentation is not received by us on the specified time period.</p>
                          <p>If you cancel within 24 hours of placing your order, you may request a refund of your purchase subject to the $50.00 processing fee which is non-refundable. If you cancel anytime thereafter, you will be held responsible for the full amount of your expediting fee because your order requires us to reserve limited capacity on your behalf. Our refund office is only open during standard business hours Eastern Standard or Daylight Savings Time. Our refund office is closed for all weekends and business holidays.</p>
                          <p>You understand by agreeing to the terms herein that you have purchased the service stated, therefore, due to such acceptance, refunds are not possible for any reason (including, but not limited to):</p>
                          <ol>
                          <li>Flight Cancellations, Missing Flights, Flight Delays or other Travel Itinerary Changes.</li>
                          <li>Delays in travel visa or other travel document deliveries.</li>
                          <li>Lost, Stolen or misplaced tickets.</li>
                          <li>Travel visa procurement difficulties, including changes in policy, regulations or requirements.</li>
                          <li>Incompleteness or inaccuracy of required filing information.</li>
                          </ol>
                          <p>The foregoing list is representative only.</p>
                          <p>We guarantee our service and delivery of your documents, but our maximum liability to any customer is the amount of fee paid to and collected by us under all circumstances from you, without limitation.</p>
                          <p>No guaranty or warranty express or implied is provided other than stated herein above. Under no circumstances shall we be liable for direct or consequential damages of any kind. Furthermore, the parties agree that the sole venue for any litigation shall be exclusively in Bergen County, New Jersey.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Privacy Modal -->
        <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="privacyModalLabel">Privacy Policy</h4>
              </div>
              <div class="modal-body">
                  <p>This privacy policy applies to www.americanvisaservices.net owned and operated by American Visa Services Inc. This privacy policy describes how American Visa Services collects and uses the personal information you provide on our web site: www.americanvisaservices.net. It also describes the choices available to you regarding our use of your personal information and how you can access and update this information.</p>
                  <p>American Visa Services is committed to protecting your privacy. We take the trust our customers and site visitors place in us very seriously. In order to process your order, we need to know some standard information such as your name, e-mail address, mailing address, date of birth, credit card number and telephone number.</p>
                  <p>For the purpose of filing your travel documents we need to know/provide to the issuing agency the following information (the following list may not be all inclusive and this information is collected offline and associated with the personal information named above and collected from you online.):</p>
                  • Current US Passport <br>
                  • Your Travel itinerary <br>
                  • Your Birth certificate <br>
                  • Your Driver's license <br>
                  <p>Our users also have the ability to submit a third party's personal information. This only occurs in the instance that a user submits their child's personal information to register them for our passport service- this information would include name, age and address. The information our user submits will be used only for the purpose for which it is collected and will not be used for any other reason. It is our Privacy Policy that this information shall remain private and confidential. Accordingly, the personal information you provide is stored in a secure location and is accessible only by designated staff. We employ the use of SSL encryption when transmitting your sensitive financial information and employ industry accepted standards in protecting your information. Your personal information is used only for the purposes for which you provide the information. We will share your personal information with third parties only in the ways that are described in this privacy policy. We do not sell your personal information to third parties. Your personal information is used only for the purposes for which you provide the information, with the following limitation: </p>
                  <ol>
                  <li>Agents: We use an outside shipping company to fulfill orders, and a credit card processing company to bill you for services. We also employ the services of a third party agent in hosting our chat feature. These companies do not retain share, store or use personally identifiable information for any other purposes.</li>
                  <li>Service Providers: We use other third parties such as The Department of State and consulates to the country of choice to provide passport and visa services on the Sites. We will share personal information as necessary for the third party to provide that service. These third parties are prohibited from using your personally identifiable information for any other purpose. When you submit an order, your information is encrypted with secure server software to protect the information from unauthorized access. We will not sell, rent or trade any personal information we collect from you on our web site unless as otherwise disclosed in this privacy statement.</li>
                  <li>Service Updates: It is our policy to keep you informed for the duration of your order; we will notify you via e-mail, telephone and sms of the status of your order. If you would rather not receive any updates from us, please send a request to be removed from our e-mail update list to: info@americanvisaservices.net </li>
                  <li>Cookies and Other Tracking Technologies: Technologies such as: cookies, beacons, tags and scripts are used by American Visa Services and our partner’s analytics providers, affiliates, service providers or online customer support provider. These technologies are used in analyzing trends, administering the site, tracking user’s movements around the site and to gather demographic information about our user base as a whole. We may receive reports based on the use of these technologies by these companies on an individual as well as aggregated basis.<br><br>
                  As is true of most web sites, we gather certain information automatically and store it in log files. This information may include internet protocol (IP) addresses, browser type, internet service provider (ISP), referring/exit pages, operating system, date/time stamp, and/or click stream data. We do not link this automatically collected data to other information we collect about you.<br><br>
                  Third parties with whom we partner to provide certain features on our site or to display advertising based upon your Web browsing activity use Local Storage Objects (LSOs) such as HTML 5 to collect and store information.</li>
                  <li>Behavioral Targeting/ Re-Targeting: We partner with a third party to either display advertising on our Web site or to manage our advertising on other sites. Our third party partner may use technologies such as cookies to gather information about your activities on this site and other sites in order to provide you advertising based upon your browsing activities and interests. If you wish to not have this information used for the purpose of serving you interest-based ads, you may opt-out by clicking here. Please note this does not opt you out of being served ads. You will continue to receive generic ads.</li>
                  <li>Order Processing: When sending personal data with credit card information over the Internet to Americanvisaservices.net, customers should feel secure in the knowledge that this data is protected by encryption over a "Secure Socket Layer (SSL)" technology, which ensures safe transmission.</li>
                  <li>Legal disclaimer: We reserve the right to disclose your personally identifiable information as required by law and when we believe that disclosure is necessary to protect our rights and/or comply with a judicial proceeding, court order, or legal process served on our Web site.
                  <br><br>
                  Changes in this Privacy Statement: If we decide to change our privacy policy, we will post those changes to this privacy statement, the home page, and other places we deem appropriate so that you are aware of what information we collect, how we use it, and under what circumstances, if any, we disclose it. We reserve the right to modify this privacy statement at any time, so please review it frequently. If we make material changes to this policy, we will notify you here, by email, or by means of a notice on our home page prior to the change becoming effective.</li>
                  <li>Business Transitions: In the event American Visa Services goes through a business transition, such as a merger, acquisition by another company, or sale of all or a portion of its assets, your personally identifiable information will likely be among the assets transferred. You will be notified via email or prominent notice on our Web site for 30 days of any such change in ownership or control of your personal information. <br><br>
                  Contacting the Website: If you have any questions about this Privacy Policy, the practices or dealings with the Sites, you can contact our Customer Service at info@americanvisaservices.net. You may also use this email address to update or delete any personal information you may have already submitted to the website.</li>
                  <li>Data Retention: We will retain your information for as long as your account is active or as needed to provide you services. We will retain and use your information as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements.</li>
                  <li>Links to 3rd Party Sites: Our Site includes links to other Web sites whose privacy practices may differ from those of American Visa Services. If you submit personal information to any of those sites, your information is governed by their privacy policies. We encourage you to carefully read the privacy policy of any Web site you visit.</li>
                  <li>Blog/ Forum: Our Web site offers publicly accessible blogs or community forums. You should be aware that any information you provide in these areas may be read, collected, and used by others who access them. To request removal of your personal information from our blog or community forum, contact us at info@americanvisaservices.net. In some cases, we may not be able to remove your personal information, in which case we will let you know if we are unable to do so and why.</li>
                  <li>Testimonials: We display personal testimonials of satisfied customers on our site in addition to other endorsements. With your consent we may post your testimonial along with your name. If you wish to update or delete your testimonial, you can contact us at info@americanvisaservices.net.</li>
                  <li>Social Media Widgets: Our Web site includes Social Media Features, such as the Facebook Like button and Widgets, such as the Share this button or interactive mini-programs that run on our site. These Features may collect your IP address, which page you are visiting on our site, and may set a cookie to enable the Feature to function properly. Social Media Features and Widgets are either hosted by a third party or hosted directly on our Site. Your interactions with these Features are governed by the privacy policy of the company providing it.</li>
                  </ol>
                  <p>
                  American Visa Services<br>
                  411 Hackensack Ave. <br>
                  Hackensack, NJ 07601<br>
                  </p>
                  info@americanvisaservices.net

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>

    <!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalError" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Error</h4>
          </div>
          <div class="modal-body">
            <p>
                {{  \Session::get('error') }}
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal -->

    <!--global js starts-->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/josh_frontend.js') }}"></script>
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
    @if(\Session::get('error','')!='')
      <script>
          $(document).ready(function({
              $('#modalError').modal("show");
          });
      </script>
    @endif

</body>

</html>
