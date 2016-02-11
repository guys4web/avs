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
                        <a href=""># {{ $order->id }}</a>
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
                        <a href="#" data-order-id="{{ $order->id }}" data-id="{{ $order->cart->id }}" class="btn-passengers btn btn-default btn-xs">Lists passengers</a>
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
      <!-- modal passenger -->
      <div id="modal-passengers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="gridSystemModalLabel">List of passengers for order #<span id="modal-order-num"></span></h4>
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
  </div>
@stop


@section('footer_scripts')
  <script>
      $(document).ready(function(){
            $('.btn-passengers').click(function(){
              $('#modal-order-num').html($(this).attr('data-order-id'));
                var cart_id = $(this).attr("data-id");
                $.get("{{route('cart_passengers')}}",{id:cart_id},function(html){
                    $('#modal-passengers .modal-body').html(html);
                    $('#modal-passengers').modal("show");
                },"html");
            });
      });
  </script>
@stop
