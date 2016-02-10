@extends("emails.layouts.default")


@section("content")
  <h3>Hi Admin</h3> , <br/>
  A new Order #{{  $order->id }} 
@stop
