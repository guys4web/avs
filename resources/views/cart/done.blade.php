@extends('layouts/default')

{{-- Page title --}}
@section('title')
Cart items
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@stop


{{-- Page content --}}
@section('content')
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
            <h2>Payment done</h2>
          </div>
      </div>
      <div class="row">
          <h4>Order information #{{ $order->id }}</h4>
      </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
@stop
