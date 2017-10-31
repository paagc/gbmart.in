@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-4" style="border-right: 1px solid #555555;">
					<div class="row">
						<h3>User Information</h3>
						<h4>
							Name: {{ $user->name }}
						</h4>
						<h4>
							Email: {{ $user->email }}
						</h4>
						<h4>
							Mobile Number: {{ $user->mobile_number }}
						</h4>
					</div>
					<div class="row">
						<h3>Addresses</h3>
						@foreach($user->addresses as $address)
						<h4>
							<i class="fa fa-arrow-right"></i> {{ $address->line_1 . ", " . $address->line_2 . ", " . $address->city_town . ", " . $address->state .  ", " . $address->pin_code }}
						</h4>
						@endforeach
						@if(count($user->addresses) == 0)
						<h4>No address found</h4>
						@endif
					</div>
				</div>
				<div class="col-md-8">
					<div class="row" style="padding-left: 25px;">
						<h3>Order History</h3>
						@if(count($orders) == 0)
						<h4>No orders found</h4>
						@else
						<table class="table">
							<thead>
								<tr>
									<th class="cart-romove item">#</th>
									<th class="cart-description item">Image</th>
									<th class="cart-product-name item">Product Name</th>
									<th class="cart-qty item">Quantity</th>
									<th class="cart-sub-total item">Amount</th>
									<th class="cart-qty item">Date</th>
									<th class="cart-total last-item">Status</th>
								</tr>
							</thead>

							<tbody>
								@foreach($orders as $order)
								<tr>
									<td class="romove-item">{{ $order->id }}</td>
									<td class="cart-image">
										<a class="entry-thumbnail" href="/store/{{ $order->product->category->name }}/{{ $order->product->sub_category->name }}/{{ $order->product->name }}">
											<img src="{{ $order->product->product_images[0]->url }}" alt="" style="max-height: 100px; max-width: 100px;">
										</a>
									</td>
									<td class="cart-product-name-info">
										<h4 class='cart-product-description'><a href="/store/{{ $order->product->category->name }}/{{ $order->product->sub_category->name }}/{{ $order->product->name }}">{{ $order->product->display_name }}</a></h4>
									</td>
									<td class="cart-product-quantity">
										<div class="cart-quantity">
											{{ $order->count }}
										</div>
									</td>
									<td class="cart-product-sub-total"><span class="cart-sub-total-price">Rs. {{ number_format($order->total_amount, 2, '.', ',') }}</span></td>
									<td class="cart-product-grand-total">
										<span class="cart-grand-total-price">
											{{ date('d-m-y H:i', strtotime($order->created_at)) }}
										</span>
									</td>
									<td>{{ $order->status }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection