@extends('layouts/default')

{{-- Page title --}}
@section('title')
Visa Application
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}"/>

<link rel="stylesheet"  href="{{ asset('assets/css/bootstrap-datepicker3.css') }}"/>
<!--end of page level css-->
<style type="text/css">
    .wizard > .content > .body {
        position:relative;
    }
</style>
@stop


{{-- Page content --}}
@section('content')
    <section class="content">
        <div class="row applicationForm">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="notebook" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Visa Application
                        </h3>
                    </div>
                    <div class="panel-body">

                        <!-- errors -->
                        <div class="has-error">
                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
                        </div>

                        <!--main content-->
                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('additem',['productId'=>'productId']) }}"
                                  method="POST" id="wizard-validation" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <h1>Visa</h1>

                                <section>

                                    <div class="form-group">
                                        <label for="service" class="col-md-6 control-label">How soon would you like to go ? *</label>
                                        <div class="col-md-6">
                                           <select class="form-control input" name="services" id="services">
                                            <option selected disabled>Please select a service</option>
                                            @if($services)
                                                @foreach($services as $id => $item)
                                                    <option value="{{$id}}">{{$item}}</option>
                                                @endforeach
                                            @endif
                                           </select>

                                        </div>
                                    </div>
                                    <div class="portlet box info">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Visa Types
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-hover" id="service_visas">
                                                <tr>
                                                    <th></th>
                                                    <th>Visa</th>
                                                    <th>Max Length of Stay</th>
                                                    <th>Fee</th>
                                                    <th></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="numPassengers">
                                        <div class="form-group" >
                                            <label for="qty" class="col-md-6 control-label">How many people are traveling ? *</label>
                                            <div class="col-sm-1">
                                                <input type="number" name="qty" id="qty" value="1" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty" class="col-md-6 control-label">Group:</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="group" id="group" >
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label for="carrier" class="col-md-6 control-label">Shipping Carrier:</label>
                                            <div class="col-sm-1">
                                                <select name="carrier" id="carrier">
                                                    <option value="USPS">USPS</option>
                                                    <option value="DHL">DHL</option>
                                                    <option value="Fedex">Fedex</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label for="track_num" class="col-md-6 control-label">Tracking Number:</label>
                                            <div class="col-sm-1">
                                                <input type="text" name="track_num" id="track_num">
                                            </div>
                                        </div>
                                    </div>
                                    <p>(*) Mandatory</p>
                                    <div class="modal fade" id="reqModal" role="dialog">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Create Visa</h4>
                                          </div>
                                          <div class="modal-body">
                                            <ul id="visa_requirements"></ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                </section>

                                <!-- second tab -->
                                <h1>Passenger(s)</h1>

                                <section>
                                    <div id="passengers">
                                    </div>
                                </section>

                                <!-- third tab -->
                                <h1>Payment</h1>
                                <section>
                                    @include('payment')
                                </section>

                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION -->
                        </div>
                        <!--main content end-->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success ">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="shopping-cart-in" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Order Summary
                        </h3>
                    </div>
                    <div class="panel-body">
                        <section>
                            <ul>
                                <li><b>Service Type: </b> <span id='service_type'></span></li>
                                <li><b>Visa Type: </b> <span id='visa_type'></span></li>
                                <li><b>Visa Fee: </b> <span id='visa_fee'></span></li>
                                <li><b>Quantity: </b> <span id='quantity'></span></li>
                            </ul>
                            <hr>
                            <div class='total'><strong>Total</strong>: <span id="order_total"></span></div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"  ></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.full.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
    <script src="{{ asset('assets/js/pages/cart.js') }}"></script>
    <script src="{{ asset('assets/js/payment.js') }}"></script>
@stop
