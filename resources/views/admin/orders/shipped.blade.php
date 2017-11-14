@extends('admin.app')

@section('content_header')
<h1>
	Shipped Orders
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Shipped Orders</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
				<form action="/admin/orders/pending" method="GET">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Seller</th>
								<th>Product</th>
								<th>Count</th>
								<th>Price</th>
								<th>Delivery Charge</th>
								<th>Payment Method</th>
								<th>Placed at</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($shipped_orders as $index => $order)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $order->seller_product->seller->name }} ({{ $order->seller_product->seller->mobile_number }})</td>
								<td>{{ $order->seller_product->product->name }}</td>
								<td>{{ $order->count }}</td>
								<td>{{ $order->price }}</td>
								<td>{{ $order->delivery_charge }}</td>
								<td>{{ $order->payment_method }}</td>
								<td>{{ $order->created_at }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="8" class="text-center">No Shipped Orders Available</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>
			<div class="box-footer clearfix">
				{{ $shipped_orders->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection