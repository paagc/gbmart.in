Dear {{$order->customer->name}},
your order has been - <strong>{{$order->status}}</strong>
Status update/remarks: {{$log->remarks}}

click here to <a href="{{url("track/{$order->id}")}}">Track Your Order</a>.

Thank you
GBMart.in