@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index">Home</a></li>
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
								<a href="index" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
							</span>
						</div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				
				<tr>
					<td class="romove-item"><a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
						    <img src="assets/images/products/p2.jpg" alt="">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="detail">Floral Print Buttoned</a></h4>
						<div class="row">
							<div class="col-sm-12">
								<div class="rating rateit-small"></div>
							</div>
							
						</div>
						
					</td>
					
					<td class="cart-product-quantity">
						<div class="cart-quantity">
							<div class="quant-input">
				                <div class="arrows">
				                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
				                </div>
				                <input type="text" value="1">
			              </div>
			            </div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">RS.300.00</span></td>
					<td class="cart-product-grand-total"><span class="cart-grand-total-price">RS.300.00</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>				
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
						</div>
						<div class="clearfix pull-right">
							<button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div>

<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md fa fa-inr">600.00</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md fa-inr">600.00</span>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<a href="checkout"><button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHECKOUT</button></a>
						
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div>			</div>
		</div>
		

</div>
</div>
@endsection