@extends('seller.app')

@section('content_header')
<h1>
	Add New Product
</h1>
<ol class="breadcrumb">
	<li><a href="/seller">Home</a></li>
	<li><a href="/seller/seller-products">Your Products</a></li>
	<li class="active">Create</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			@if(Session::has('error'))
			<p class="text-red text-center">{{ Session::get('error') }}</p>
			@endif
			@if(Session::has('success'))
			<p class="text-green text-center">{{ Session::get('success') }}</p>
			@endif
			<form role="form" action="/seller/seller-products/create" method="POST">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputProduct">Product</label>
								<select name="product_id" class="form-control" id="inputProduct">
									<option></option>
									@foreach($products as $product)
									<option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>{{ $product->display_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputSellerPrice">Price</label>
								<input type="text" name="seller_price" class="form-control" id="inputSellerPrice" placeholder="Enter seller price" value="{{ old('seller_price') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputDeliveryCharge">Delivery Charge</label>
								<input type="text" name="delivery_charge" class="form-control" id="inputDeliveryCharge" placeholder="Enter delivery charge" value="{{ old('delivery_charge') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="inputIsInStock">Is in stock?</label>
								<br>
								<input type="checkbox" name="is_in_stock" id="inputIsInStock" value="true" @if(old('is
								_in_stock') == "true") checked @endif>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="inputIsCODAvailable">Is COD Available?</label>
								<br>
								<input type="checkbox" name="is_cod_available" id="inputIsCODAvailable" value="true" @if(old('is_cod_available') == "true") checked @endif>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="inputOnlinePaymentAvailable">Is Online Payment Available?</label>
								<br>
								<input type="checkbox" name="is_online_payment_available" id="inputOnlinePaymentAvailable" value="true" @if(old('is_online_payment_available') == "true") checked @endif>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection