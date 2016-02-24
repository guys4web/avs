@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a package
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Packages</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>packages</li>
        <li class="active">Create New package</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit package
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($package, ['method' => 'PATCH', 'action' => ['PackagesController@update', $package->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('passenger_name', 'Passenger Name: ') !!}
                        {!! Form::text('passenger_name', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('carrier', 'Carrier: ') !!}
                        {!! Form::text('carrier', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('tracking_num', 'Tracking Num: ') !!}
                        {!! Form::text('tracking_num', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@stop