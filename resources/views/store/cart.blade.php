@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="cart-romove item">Remove</th>
									<th class="cart-description item">Image</th>
									<th class="cart-product-name item">Product Name</th>

									<th class="cart-qty item">Quantity</th>
									<th class="cart-sub-total item">Shipping</th>
									<th class="cart-total last-item">Grandtotal</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan="7">
										<div class="shopping-cart-btn">
											<span class="">
												<a href="/" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
												<!-- <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> -->
											</span>
										</div>
									</td>
								</tr>
							</tfoot>
							<tbody>
								@foreach($cart_items as $item)
								<tr>
									<td class="romove-item"><a href="/store/cart/remove/{{ $item['rowId'] }}" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
									<td class="cart-image">
										<a class="entry-thumbnail" href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}-{{ $item['seller_product']->id }}">
											<img src="{{ $item['seller_product']->product->product_images[0]->url }}" alt="">
										</a>
									</td>
									<td class="cart-product-name-info">
										<h4 class='cart-product-description'>
											<a href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}-{{ $item['seller_product']->id }}">
												{{ $item['seller_product']->product->display_name }}
											</a>
										</h4>
										<div class="row">
											<div class="col-sm-12">
												<div class="rating rateit-small"></div>
											</div>

										</div>

									</td>

									<td class="cart-product-quantity">
										{{ $item['quantity'] }}
									</td>
									<td class="cart-product-sub-total"><span class="cart-sub-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'], 2, '.', ',') }}</span></td>
									<td class="cart-product-grand-total"><span class="cart-grand-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'] + $item['seller_product']->delivery_charge, 2, '.', ',') }}</span></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 cart-shopping-total">
					<table class="table">
						<thead>
							<tr>
								<th>
									<div class="cart-sub-total">
										Subtotal<span class="inner-left-md fa fa-inr">{{ number_format($subtotal, 2, '.', ',') }}</span>
									</div>
									<div class="cart-grand-total">
										Grand Total<span class="inner-left-md fa-inr">{{ number_format($total, 2, '.', ',') }}</span>
									</div>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="cart-checkout-btn pull-right">
										<a href="/store/checkout"><button class="btn btn-primary checkout-btn">PROCCED TO CHECKOUT</button></a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>			
			</div>
		</div>
	</div>
</div>
@endsection