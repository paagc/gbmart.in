@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="\">Home</a></li>
				<li><a href="#">{{ $sub_category->category->display_name }}</a></li>
				<li class='active'>{{ $sub_category->display_name }}</li>
			</ul>
		</div>
	</div>
</div>
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					<div class="sidebar-filter">
						<div class="sidebar-widget wow fadeInUp">
							<h3 class="section-title">Shop By &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary filter-button">Filter</button></h3>
							<div class="widget-header">
								<h4 class="widget-title">Brands</h4>
							</div>
							<div class="sidebar-widget-body">
								<ul>
									@foreach($brands as $brand)
									<div class="checkbox"> <label> <input type="checkbox" class="check-brand" data-value="{{ $brand }}" @if (array_key_exists($brand, $selected_brands)) checked @endif> {{ $brand }} </label> </div>
									@endforeach
								</ul>
							</div>
						</div>

						<div class="sidebar-widget wow fadeInUp">
							<div class="widget-header">
								<h4 class="widget-title">Price Slider</h4>
							</div>
							<div class="sidebar-widget-body m-t-10">
								<div class="price-range-holder">
									<span class="min-max">
										<span class="pull-left"><span class="fa fa-inr"></span>{{ $price_range_min }}</span>
										<span class="pull-right"><span class="fa fa-inr"></span>{{ $price_range_max }}</span>
									</span>
									<input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">

									<input type="text" class="price-range-slider" value="{{ $price_min }},{{ $price_max }}" >
								</div>
							</div>
						</div>

						@if (count($featured_products) > 0)
						<div class="sidebar-widget outer-bottom-small wow fadeInUp">
							<h3 class="section-title">FEATURED PRODUCTS</h3>
							<div class="sidebar-widget-body outer-top-xs">
								<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
									<div class="item">
										<div class="products special-product">
											@foreach($featured_products as $product)
											<div class="product">
												<div class="product-micro">
													<div class="row product-micro-row">
														<div class="col col-xs-5">
															<div class="product-image">
																<div class="image custom-product-image"> 
																	<a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}"> 
																		<img src="{{ $product->product_images[0]->url }}" alt=""> 
																	</a> 
																</div>
															</div>
														</div>

														<div class="col col-xs-7">
															<div class="product-info">
																<h3 class="name">
																	<a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ (strlen($product->display_name) > 20 ? substr($product->display_name, 0, 15) . "..." : $product->display_name) }}</a>
																</h3>
																<div class="rating rateit-small"></div>
																<div class="product-price"> <span class="price"><span class="fa fa-inr"></span>{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }} </span> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif

					</div>
				</div>
			</div>
			<div class='col-md-9'>
				<div id="hero">
					<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
						<div class="item" style="background-image: url(/assets/images/sliders/01.jpg);">
							<div class="container-fluid">
							</div>
						</div>

						<div class="item" style="background-image: url(/assets/images/sliders/02.jpg);">
							<div class="container-fluid">
							</div>
						</div>
					</div>
				</div>

				<div class="clearfix filters-container m-t-10">
					<div class="row">
					</div>
				</div>
				<div class="search-result-container ">
					<div id="myTabContent" class="tab-content category-list">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product">
								<div class="row">
									@if (count($products) > 0)
									@foreach ($products as $product)
									<div class="col-sm-6 col-md-4 wow fadeInUp">
										<div class="products">
											<div class="product">		
												<div class="product-image">
													<div class="image custom-product-image">
														<a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}"><img  src="{{ $product->product_images[0]->url }}" alt=""></a>
													</div>	
												</div>
												<div class="product-info text-left">
													<h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ (strlen($product->display_name) > 20 ? substr($product->display_name, 0, 15) . "..." : $product->display_name) }}</a></h3>
													<div class="rating rateit-small"></div>
													<div class="description">{{ $product->description_small }}</div>

													<div class="product-price">	
														<span class="price fa fa-inr">
															{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }}				</span>
															<span class="price-before-discount fa fa-inr">{{ number_format($product->original_price, 2, '.', ',') }}</span>

														</div>

													</div>
													<div class="cart clearfix animate-effect">
														<div class="action">
															<ul class="list-unstyled">
																<li class="add-cart-button btn-group">
																	<button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary icon seller-product" data-toggle="dropdown" type="button">
																		<i class="fa fa-shopping-cart"></i>													
																	</button>
																	<button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</button>

																</li>

																<li class="lnk wishlist">
																	<a class="add-to-cart" title="Wishlist">
																		<i class="icon fa fa-heart"></i>
																	</a>
																</li>

																<li class="lnk">
																	<a seller-product-id="{{ $product->seller_products[0]->id }}" class="add-to-cart buy-now" title="Buy now">
																		<i class="fa fa-shopping-bag"></i>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>

											</div>
										</div>
										@endforeach
										@else
										<h3 class="text-center">No products found.</h3>
										@endif
									</div><!-- /.row -->
								</div><!-- /.category-product -->
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->

						<?php 
						$url = url()->full();
						$url = str_replace("?page=" . $page, "", $url);
						$url = str_replace("&page=" . $page, "", $url);
						$url_query_append = "?";
						if (stripos($url, "?")) {
							$url_query_append = "&";
						}
						?>
						@if ($page_count > 1)
						<div class="clearfix filters-container">
							<div class="text-right">
								<div class="pagination-container">
									<ul class="list-inline list-unstyled">
										@if ($page > 1)
										<li class="prev"><a href="{{ $url . $url_query_append . "page=" . ($page - 1) }}"><i class="fa fa-angle-left"></i></a></li>
										@endif

										@for ($i = 1; $i <= $page_count; $i++)
										<li @if ($page == $i) class="active" @endif><a href="{{ $url . $url_query_append . "page=" . $i }}">{{ $i }}</a></li>
										@endfor

										@if ($page == $page_count)
										<li class="next"><a href="{{ $url . $url_query_append . "page=" . ($page + 1) }}"><i class="fa fa-angle-right"></i></a></li>
										@endif
									</ul>
								</div>						    
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('footer')
<script>
	jQuery(function () {

		if (jQuery('.price-range-slider').length > 0) {
			jQuery('.price-range-slider').slider({
				min: {{ $price_range_min }},
				max: {{ $price_range_max }},
				step: 100,
				value: [{{ $price_min }}, {{ $price_max }}],
				handle: "square"
			});
		}

		function filter() {
			var url = "{{ url()->current() }}";
			var selected_brands = [];
			var price_min = {{ $price_min }}, price_max = {{ $price_max }}, price_range_min = {{ $price_range_min }}, price_range_max = {{ $price_range_max }};
			var page = {{ $page }};
			$('.check-brand').each(function () {
				if($(this).prop('checked') == true) {
					selected_brands.push($(this).attr('data-value'));
				}
			});
			var price_values = $('input.price-range-slider').val().split(',');
			if (price_values.length == 2) {
				price_min = parseInt(price_values[0]);
				price_max = parseInt(price_values[1]);
			}
			if (selected_brands.length > 0 || price_min != price_range_min || price_max != price_range_max) {
				url += "?";
				if (selected_brands.length > 0) {
					for (var i = 0; i < selected_brands.length; i++) {
						url += ((url.includes('&') ? "&" : "")) + "selected_brands[]=" + selected_brands[i];
					}
				}
				if (price_min != price_range_min) {
					url += ((url.includes('&') ? "&" : "")) + "price_min=" + price_min;
				}
				if (price_max != price_range_max) {
					url += ((url.includes('&') ? "&" : "")) + "price_max=" + price_max;
				}
				if (page > 1) {
					url += ((url.includes('&') ? "&" : "")) + "page=" + page;
				}
			}

			window.location.href = url;
		}

		$('.filter-button').click(filter);

        $('.seller-product').click(function () {
            window.location.href = '/store/cart/add/' + $(this).attr('seller-product-id');
        });
        
        $('.buy-now').click(function () {
            window.location.href = '/store/cart/buy-now/' + $(this).attr('seller-product-id');
        });
	});
</script>
@endsection