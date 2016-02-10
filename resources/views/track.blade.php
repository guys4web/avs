@extends('layouts.default')


@section('content')
  <div class="container">
      <div class="welcome">
          <h3>My Orders</h3>
      </div>
      <div class="row">
          <table class="table table-striped">
              @foreach($orders as $order)
                <tr>
                    <td>
                        # {{ $order->id }}
                    </td>
                </tr>
              @endforeach
          </table>
      </div>
  </div>
@stop
