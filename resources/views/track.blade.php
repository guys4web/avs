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
                    <td>
                        <ul>
                            @foreach($order->cart->cartItems as $item)
                              <li>
                                  {{  $item->product->service->name }}
                                  <br/>
                                  {{ $item->product->visa->name }}
                              </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if(empty($order->status))
                          <label class="label label-danger">Stand by</label>
                        @endif
                    </td>
                </tr>
              @endforeach
          </table>
      </div>
  </div>
@stop
