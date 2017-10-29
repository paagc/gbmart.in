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
			<form action="/store/checkout" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="payment_reference" value="{{ $payment_reference }}">
				<div class="row">
					<div class="col-md-12">
						<div class="panel-group checkout-steps">
							<div class="panel panel-default checkout-step-03">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">
										<a href="#">
											<span>1</span>Shipping Information
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in">
									<div class="panel-body">
										<div class="row">
											<h5>Existing Addresses</h5>
											@foreach($addresses as $address)
											<div class="col-md-12">
												<div class="radio">
													<input type="radio" name="address" value="{{ $address->id }}"> 
													<label>{{ $address->line_1 . ", " . $address->line_2 . ", " . $address->city_town . ", " . $address->state .  ", " . $address->pin_code }}</label>
												</div>
											</div>
											@endforeach
											<div class="col-md-12">
												<div class="radio">
													<input type="radio" name="address" value="new"> 
													<label>New address ?</label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="new_address[line_1]" class="form-control" placeholder="Line 1">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="new_address[line_2]" class="form-control" placeholder="Line 2">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="new_address[city_town]" class="form-control" placeholder="City/Town">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="new_address[state]" class="form-control" placeholder="State">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="new_address[pin_code]" class="form-control" placeholder="PIN Code">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-default checkout-step-06">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">
										<a href="#">
											<span>2</span>Payment method
										</a>
									</h4>
								</div>
								<div id="collapseSix" class="panel-collapse collapse in">
									<div class="panel-body">
										<div class="panel-heading">
											<h4 class="unicase-checkout-title">
												Select your Payment Method
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="radio">
															<input type="radio" name="payment_method" value="COD"> 
															<label> Cash on delivery (COD)</label>
														</div>
													</div>
													<div class="col-md-12">
														<div class="radio">
															<input type="radio" name="payment_method" value="ONLINE"> 
															<label> Card Payment / Internet Banking / Wallets</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-default checkout-step-06">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">
										<a href="#">
											<span>3</span>Order Review
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse in">
									<div class="panel-body">
										<div class="body-content outer-top-xs">
											<div>
												<div class="row">
													<div class="shopping-cart">
														<div class="shopping-cart-table ">
															<div class="table-responsive">
																<table class="table">
																	<thead>
																		<tr>
																			<th class="cart-romove item">#</th>
																			<th class="cart-description item">Image</th>
																			<th class="cart-product-name item">Product Name</th>
																			<th class="cart-qty item">Quantity</th>
																			<th class="cart-sub-total item">Shipping</th>
																			<th class="cart-total last-item">Grand Total</th>
																		</tr>
																	</thead>

																	<tbody>
																		@foreach($cart_items as $index => $item)
																		<tr>
																			<td class="romove-item">{{ $index + 1 }}</td>
																			<td class="cart-image">
																				<a class="entry-thumbnail" href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}">
																					<img src="{{ $item['seller_product']->product->product_images[0]->url }}" alt="">
																				</a>
																			</td>
																			<td class="cart-product-name-info">
																				<h4 class='cart-product-description'><a href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}">{{ $item['seller_product']->product->display_name }}</a></h4>
																			</td>
																			<td class="cart-product-quantity">
																				<div class="cart-quantity">
																					{{ $item['quantity'] }}
																				</div>
																			</td>
																			<td class="cart-product-sub-total"><span class="cart-sub-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'], 2, '.', ',') }}</span></td>
																			<td class="cart-product-grand-total"><span class="cart-grand-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'] + $item['seller_product']->delivery_charge, 2, '.', ',') }}</span></td>
																		</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
														<center>
															<div class="col-md-4 col-sm-12 cart-shopping-total">
																<table class="table">
																	<thead>
																		<tr>
																			<th>
																				<div class="cart-sub-total">
																					Sub Total<span class="inner-left-md fa fa-inr">{{ number_format($subtotal, 2, '.', ',') }}</span>
																				</div>
																				<div class="cart-grand-total">
																					Grand Total<span class="inner-left-md fa fa-inr">{{ number_format($total, 2, '.', ',') }}</span>
																				</div>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																	</tbody>
																</table>
															</div>		
														</center>
														<div class="cart-checkout-btn pull-right">
															<button type="submit" class="btn btn-primary checkout-btn">Place Order</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection