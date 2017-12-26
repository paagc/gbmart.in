Dear {{$order->customer->name}},
your order has been - <strong>{{$order->status}}</strong>

click here to <a href="{{url("track/{$order->payment_reference}/{$order->id}")}}">Track Your Order</a>.

Thank you
GBMart.in