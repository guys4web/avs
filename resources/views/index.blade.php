@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl-carousel/owl.theme.css') }}">
    <!--end of page level css-->
@stop

{{-- slider --}}
@section('top')
    <!--Carousel Start -->
    <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item"><img src="{{ asset('assets/images/slide_1.jpg') }}" alt="slider-image">
        </div>
        <div class="item"><img src="{{ asset('assets/images/slide_2.jpg') }}" alt="slider-image">
        </div>
        <div class="item"><img src="{{ asset('assets/images/slide_3.jpg') }}" alt="slider-image">
        </div>
    </div>
    <!-- //Carousel End -->
@stop

{{-- content --}}
@section('content')
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-1"></div>
                    <form class="form-horizontal" id="form-home" action="{{ route('apply') }}" method="post">
                        <fieldset>

                            <div class="form-group">

                                <div class="col-md-3">
                                    {!! Form::select('from_country', $fromCountry, '',['class' => 'form-control select2', 'id' => 'from_country']) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('country', $countries, '',['class' => 'form-control select2', 'id' => 'country']) !!}
                                </div>

                                <div class="col-md-3">
                                    {!! Form::select('state', $states, '',['class' => 'form-control select2', 'id' => 'state']) !!}
                                </div>

                            <!-- Form actions -->
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-responsive btn-primary">Get Started</button>
                                </div>
                            </div>
                         </fieldset>
                     </form>
                </div>
            </div>
        <!-- Service Section Start-->
        <div class="row">
            <!-- Responsive Section Start -->
            <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Our Services</span></h3>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon">
                        <i class="livicon icon" data-name="globe" data-size="55" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    </div>
                    <div class="info">
                        <h3 class="success text-center">VISA RESOURCES</h3>
                        <p>See the necessary documents and entry requirements for each country with travel visa checklist.</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Responsive Section End -->
            <!-- Easy to Use Section Start -->
            <div class="col-sm-6 col-md-3">
                <!-- Box Start -->
                <div class="box">
                    <div class="box-icon box-icon1">
                        <i class="livicon icon1" data-name="info" data-size="55" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                    </div>
                    <div class="info">
                        <h3 class="primary text-center">TRAVEL TIPS</h3>
                        <p>Visit our Blog to see helpful travel tips and the latest visa news from around the world.</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Easy to Use Section End -->
            <!-- Clean Design Section Start -->
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon box-icon2">
                        <i class="livicon icon1" data-name="users" data-size="55" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
                    </div>
                    <div class="info">
                        <h3 class="warning text-center">GROUP DISCOUNTS</h3>
                        <p>Discounts are available for groups of 10 or more.</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Clean Design Section End -->
            <!-- 20+ Page Section Start -->
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon box-icon2">
                        <i class="livicon icon1" data-name="sitemap" data-size="55" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
                    </div>
                    <div class="info">
                        <h3 class="warning text-center">CORPORATES</h3>
                        <p>Find out how your organization can benefit by signing up for a corporate account.</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //20+ Page Section End -->
        </div>
        <!-- //Services Section End -->
    </div>

    <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <!--page level js ends-->

@stop
