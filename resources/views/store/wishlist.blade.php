@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Wishlist</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="my-wishlist-page">
			<div class="row">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">My Wishlist</th>
				</tr>
			</thead>
			<tbody>
				@foreach($wishlist as $item)
				<tr>
					<td class="col-md-2"><img src="{{ $item->product->product_images[0]->url }}" alt=""></td>
					<td class="col-md-7">
						<div class="product-name"><a href="/store/{{ $item->product->category->name }}/{{ $item->product->sub_category->name }}/{{ $item->product->name }}">{{ $item->product->display_name }}</a></div>
						<div class="rating">
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star non-rate"></i>
						</div>
					<div class="price fa fa-inr">
							{{ number_format($item->product->seller_products[0]->seller_price, 2, '.', ',') }}
							<span class="fa fa-inr">{{ number_format($item->product->original_price, 2, '.', ',') }}</span>
						</div>
					</td>
					<td class="col-md-2">
						<a seller-product-id="{{ $item->product->seller_products[0]->id }}" href="#" class="btn-upper btn btn-primary">Add to cart</a>
					</td>
					<td class="col-md-1 close-btn">
						<a product-id="{{ $item->product->id }}" href="#" class="remove-wishlist"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@if(count($wishlist) < 1)
		<h3>No products on your wishlist</h3>
		@endif
	</div>
</div>			</div>
		</div>
		
	</div>
</div>

@endsection

@section('footer')
<script>
	$(document).ready(function () {
        $('.seller-product').click(function () {
            window.location.href = '/store/cart/add/' + $(this).attr('seller-product-id');
        });

        $('.remove-wishlist').click(function () {
        	var url = '/store/wishlist/remove/' + $(this).attr('product-id');
        	window.location.href = url;
        });
    });
</script>
@endsection
