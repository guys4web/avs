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
<!--end of page level css-->
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.users.store') }}"
                                  method="POST" id="wizard-validation" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <h1>Visa Information</h1>

                                <section>

                                    <div class="form-group">
                                        <label for="service" class="col-md-6 control-label">How soon would you like to go to <b> {{ $country->name}}</b> ? *</label>
                                        <div class="col-md-3">
                                            {!! Form::select('service', $services, '',['class' => 'form-control select2', 'id' => 'service']) !!}
                                        </div>
                                    </div>


                                    <p>(*) Mandatory</p>

                                </section>

                                <!-- second tab -->
                                <h1>Bio</h1>

                                <section>


                                    <div class="form-group required">
                                        <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                        <div class="col-sm-10">
                                            <input id="dob" name="dob" type="text" class="form-control"
                                                   data-mask="9999-99-99" value="{!! Input::old('dob') !!}"
                                                   placeholder="yyyy-mm-dd"/>
                                        </div>
                                        <span class="help-block">{{ $errors->first('dob', ':message') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                    <img src="http://placehold.it/200x200" alt="profile pic">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="pic" name="pic" type="file" class="form-control" />
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group required">
                                        <label for="bio" class="col-sm-2 control-label">Bio <small>(brief intro)</small></label>
                                        <div class="col-sm-10">
                                            <textarea name="bio" id="bio" class="form-control" rows="4">{!! Input::old('bio') !!}</textarea>
                                        </div>
                                    </div>

                                </section>

                                <!-- third tab -->
                                <h1>Address</h1>
                                <section>

                                    <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                                        <label for="email" class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" title="Select Gender..." name="gender">
                                                <option value="">Select</option>
                                                <option value="male" @if(Input::old('gender') === 'male') selected="selected" @endif >MALE</option>
                                                <option value="female" @if(Input::old('gender') === 'female') selected="selected" @endif >FEMALE</option>
                                                <option value="other" @if(Input::old('gender') === 'other') selected="selected" @endif >OTHER</option>

                                            </select>
                                        </div>
                                        <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <label for="country" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            {!! Form::select('country', $countries, '',['class' => 'form-control select2', 'id' => 'countries']) !!}
                                        </div>
                                        <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                                    </div>

                                    <div class="form-group required">
                                        <label for="state" class="col-sm-2 control-label">State</label>
                                        <div class="col-sm-10">
                                            <input id="state" name="state" type="text" class="form-control"
                                                   value="{!! Input::old('state') !!}"/>
                                        </div>
                                        <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                                    </div>

                                    <div class="form-group required">
                                        <label for="city" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-10">
                                            <input id="city" name="city" type="text" class="form-control"
                                                   value="{!! Input::old('city') !!}"/>
                                        </div>
                                        <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                                    </div>

                                    <div class="form-group required">
                                        <label for="address" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input id="address" name="address" type="text" class="form-control"
                                                   value="{!! Input::old('address') !!}"/>
                                        </div>
                                        <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                    </div>

                                    <div class="form-group required">
                                        <label for="postal" class="col-sm-2 control-label">Postal/zip</label>
                                        <div class="col-sm-10">
                                            <input id="postal" name="postal" type="text" class="form-control"
                                                   value="{!! Input::old('postal') !!}"/>
                                        </div>
                                        <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                                    </div>

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
                            Service Type: 
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
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
@stop