@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group checkout-steps" id="accordion">
						
<div class="panel panel-default checkout-step-01">

	
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>User Login
	        </a>
	     </h4>
    </div>
  

	<div id="collapseOne" class="panel-collapse collapse in">

	
	    <div class="panel-body">
			<div class="row">		

				
				
			
				<div class="col-md-6 col-sm-6 already-registered-login">
				
					<p class="text title-tag-line">Please log in below:</p>
					<form class="register-form" role="form">
						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
					    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
					    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" placeholder="">
					  
					    <a href="login" class="forgot-password">Register Now</a>
					  </div>
					  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
					</form>
				</div>	
			

			</div>			
		</div>
		

	</div><
</div>

				
					  	<div class="panel panel-default checkout-step-02">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
						          <span>2</span>Billing Information
						        </a>
						      </h4>
						    </div>
						    <div id="collapseTwo" class="panel-collapse collapse">
						      <div class="panel-body">
						
					<form class="register-form" role="form" method="post">
<div class="form-group">
					    <label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input" name="billingaddress" required="required"></textarea>
					  </div>



						<div class="form-group">
					    <label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
			 <input type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate"  required>
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="Billing City">Billing City <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required">
					  </div>
 <div class="form-group">
					    <label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required">
					  </div>


					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form>
							</div>
						    </div>
					  	</div>
					  
					  	<div class="panel panel-default checkout-step-03">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
						       		<span>3</span>Shipping Information
						        </a>
						      </h4>
						    </div>
						    <div id="collapseThree" class="panel-collapse collapse">
						      <div class="panel-body">
						     <form class="register-form" role="form" method="post">
<div class="form-group">
					    <label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input"  name="shippingaddress" required="required"></textarea>
					  </div>



						<div class="form-group">
					    <label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
			 <input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" required>
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="Billing City">Shipping City <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required">
					  </div>
 <div class="form-group">
					    <label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required">
					  </div>


					  <button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form>
							  </div>
						    </div>
					  	</div>
					  	
					   
<div class="panel panel-default checkout-step-06">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix">
						        	<span>4</span>Payment method
						        </a>
						      </h4>
						    </div>
					    	<div id="collapseSix" class="panel-collapse collapse">
					      		<div class="panel-body">
					        	<div class="panel-heading">
																				<h4 class="unicase-checkout-title">
																					<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
																						Select your Payment Method
																					</a>
																				</h4>
																			</div>
																				<div id="collapseOne" class="panel-collapse collapse in">
																				
																				<!-- panel-body  -->
																				<div class="panel-body">
																					<form name="payment" method="post">
																					<input type="radio" name="paymethod" value="COD" checked="checked"> COD
																					
																					<input type="radio" name="paymethod" value="Debit / Credit card"> Debit / Credit card <br /><br />
																					<input type="submit" value="submit" name="submit" class="btn btn-primary">
																					
																					
																					</form>		
																					</div>
																				
																					
																					</div>
								</div>
					    	</div>
					  	</div>
					  	
						
					  
					  	<div class="panel panel-default checkout-step-06">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSeven">
						        	<span>5</span>Order Review
						        </a>
						      </h4>
						    </div>
					    	<div id="collapseSeven" class="panel-collapse collapse">
					      		<div class="panel-body">
					        	<div class="body-content outer-top-xs">
	<div>
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


<center><div class="col-md-4 col-sm-12 cart-shopping-total">
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
							<a href="checkout"><button type="submit" class="btn btn-primary checkout-btn">Place Order</button></a>
						
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div>		</center>	</div>
		</div>
		

</div>
</div>

								</div>
					    	</div>
					  	</div>
					  	
					  	
					</div><
				</div>
				<div class="col-md-4">
					
	</div>
			</div>
		</div>

</div>
</div>
@endsection