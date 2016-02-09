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
            <h2>Cart items</h2>
          </div>
      </div>
      <div class="row">
        <table class="col-xs-6 col-md-8 table table-stripped">
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
        </table>
        <div class="col-xs-6 col-md-4">

        </div>
      </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
@stop
