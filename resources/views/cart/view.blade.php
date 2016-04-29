@extends('layouts/default')

{{-- Page title --}}
@section('title')
Cart items
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet"/>
  <link rel="stylesheet"  href="{{ asset('assets/css/bootstrap-datepicker3.css') }}"/>
@stop


{{-- Page content --}}
@section('content')
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
            <h2>Cart items</h2>
          </div>
      </div>
      <div class="row">
        
        <div class="col-xs-6 col-md-8 ">
            @if(Session::has('error'))
                <div class="alert alert-danger"><em> {!! session('error') !!}</em></div>
            @endif
            <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Service name & visa </th>
                    <th> Number / Quantity </th>
                    <th>Unit price</th>
                    <th>Total price</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                  <tr>
                      <td>
                          {{ $item->product->visa->name }} <br/>
                          {{ $item->product->service->name }}
                      </td>
                      <td>
                          {{ $item->quantity }}
                      </td>
                      <td>
                          ${{ $item->product->price }}
                      </td>
                      <td>
                          ${{ $item->product->price*$item->quantity  }}
                      </td>
                      <td>
                        <a href="{{route('removeitem',['id'=>$item->id])}}"><i class="fa fa-remove"></i></a>
                      </td>
                  </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr >
                    <td colspan="5">
                        <form method="POST" action="{{ route('cart_payment') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button class="btn btn-primary" type="submit">Make payment</button>
                            <a data-toggle="modal" href="#modal-billing" data-id="{{ $cart->id }}" class="btn btn-default"  id="edit-billing">Edit Billing Informations</a>
                            <button data-id="{{ $cart->id }}" class="btn btn-default" type="button" id="view-passengers">List of passengers</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="col-xs-6 col-md-4">
          <section>
              <ul @if($cart->payment_type!="cc") class="hidden" @endif>
                  <li><b>Card Number : </b> <span> {{ session('cardnum','') }} </span></li>
                  <li><b>Expiration Date : </b> <span> {{ session('expDate','') }} </span></li>
                  <li><b>CCV : </b> <span>  {{ session('ccv','') }} </span></li>
                  <li><b>Name on Card : </b> <span>  {{ session('bname','') }} </span></li>
              </ul>
              <ul @if($cart->payment_type=="cc") class="hidden" @endif>
                  <li><b>Payment Type : </b> <span> {{ ($cart->payment_type=="check")?"Check":"Order Money" }} </span></li>
              </ul>
          </section>
        </div>
      </div>
    </div>
    <!-- modal passenger -->
    <div id="modal-passengers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">List of passengers<span id="modal-order-num"></span></h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- end modal -->
    
    <!-- modal billing informations -->
    <div id="modal-billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog modal-lg">
        <form class="form-horizontal modal-content" method="POST" action="{{ route('cart_billing') }}">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">List of passengers<span id="modal-order-num"></span></h4>
              </div>
              <div class="modal-body">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      @include("payment")
         
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Valider</button>
              </div>
        </form><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- end modal -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/select2/select2.full.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"  ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/payment.js') }}"></script>
    <script>
        $(document).on('click','#view-passengers',function(){
          var cart_id = $(this).attr("data-id");
          $.get("{{route('cart_passengers')}}",{id:cart_id},function(html){
              $('#modal-passengers .modal-body').html(html);
              $('#modal-passengers').modal("show");
          },"html");
        });
        $(document).ready(function(){
            $('#payment_type').trigger("change");
            $('#cardnum').val({{ session('cardnum') }});
        });
    </script>
@stop
