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
			@if(is_null($product))
			<form role="form" action="/seller/seller-products/create" method="GET">
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
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
			@else
			<form role="form" action="/seller/seller-products/create" method="POST">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputProduct">Product</label>
								<!-- <select name="product_id" class="form-control" id="inputProduct">
									<option></option>
									@foreach($products as $product)
									<option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>{{ $product->display_name }}</option>
									@endforeach
								</select> -->
								<input type="hidden" name="product_id" value="{{ $product->id }}">
								<h4>{{ $product->display_name }}</h4>
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
					@if(count($product->attributes) > 0)
					<div class="row">
						<div class="col-md-12">
							<h4>Attributes</h4>
							@foreach($product->attributes as $attribute)
							<h5>{{ $attribute->name }}</h5>
							<div class="row add_more_attributes" data="{{ $attribute->id }}">
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" name="attributes[{{ $attribute->id }}][]" class="form-control">
									</div>
								</div>
							</div>
							<a href="javascript:void(0)" class="click_to_add">+ add more</a>
							@endforeach
						</div>
					</div>
					@endif
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
			@endif
		</div>
	</div>
</div>
@endsection

@section('footer')
<script>
	$(document).ready(function() {
		$('.click_to_add').click(function() {
			var sibling = $(this).siblings('.add_more_attributes');
			var attr_id = sibling.attr('data');
			sibling.append('<div class="col-md-3"><div class="form-group"><input type="text" name="attributes['+attr_id+'][]" class="form-control"></div></div>');
		})
	})
</script>
@endsection