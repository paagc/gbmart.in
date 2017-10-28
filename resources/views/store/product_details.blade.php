@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li><a href="#">{{ $main_product->category->display_name }}</a></li>
				<li><a href="/store/{{ $main_product->category->name }}/{{ $main_product->sub_category->name }}">{{ $main_product->sub_category->display_name }}</a></li>
				<li class='active'>{{ $main_product->display_name }}</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					@if (count($hot_deal_products) > 0)
					<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
						<h3 class="section-title">Hot Deals</h3>
						<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
							@foreach ($hot_deal_products as $product)
							<div class="item">
								<div class="products">
									<div class="hot-deal-wrapper">
										<div class="image"> <img src="{{ $product->product_images[0]->url }}" alt=""> </div>
									</div>
									<div class="product-info text-left m-t-20">
										<h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ $product->display_name }}</a></h3>
										<div class="rating rateit-small"></div>
										<div class="product-price"> <span class="price"><span class="fa fa-inr"></span>{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }}</span> 
											<span class="price-before-discount"><span class="fa fa-inr"></span>{{ number_format($product->original_price, 2, '.', ',') }}</span> 
										</div>
									</div>
									<div class="cart clearfix animate-effect">
										<div class="action">
											<div class="add-cart-button btn-group">
												<button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary icon seller-product" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
												<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
												<button class="btn btn-primary cart-btn" type="button">Buy now</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@endif
					
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
															<div class="image"> <a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}"> <img src="{{ $product->product_images[0]->url }}" alt=""> </a> </div>
														</div>
													</div>
													<div class="col col-xs-7">
														<div class="product-info">
															<h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ $product->display_name }}</a></h3>
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
			<div class='col-md-9'>
				<div class="detail-block">
					<div class="row  wow fadeInUp">
						<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
							<div class="product-item-holder size-big single-product-gallery small-gallery">
								<div id="owl-single-product">
									@foreach($main_product->product_images as $index => $main_product_image)
									<div class="single-product-gallery-item" id="slide{{ $index + 1 }}">
										<a data-lightbox="image-{{ $index + 1 }}" data-title="Gallery" href="{{ $main_product_image->url }}">
											<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="{{ $main_product_image->url }}" />
										</a>
									</div>
									@endforeach
								</div>

								<div class="single-product-gallery-thumbs gallery-thumbs">
									<div id="owl-single-product-thumbnails">
										@foreach($main_product->product_images as $index => $main_product_image)
										<div class="item">
											<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{ $index + 1 }}" href="#slide{{ $index + 1 }}">
												<img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="{{ $main_product_image->url }}" />
											</a>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>     			
						<div class='col-sm-6 col-md-7 product-info-block'>
							<div class="product-info">
								<h1 class="name">{{ $main_product->display_name }}</h1>

								<div class="rating-reviews m-t-20">
									<div class="row">
										<div class="col-sm-12">
											<div class="rating rateit-small"></div>
										</div>
									</div>
								</div>

								<div class="stock-container info-container m-t-10">
									<div class="row">
										<div class="col-sm-2">
											<div class="stock-box">
												<span class="label">Availability :</span>
											</div>	
										</div>
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="value text-red">{{ ($main_product->seller_products[0]->is_in_stock ? "In Stock" : "Out Of Stock") }}</span>
											</div>	
										</div><br>

									</div><p>{{ $main_product->description_small }}</p>
								</div>

								<div class="price-container info-container m-t-20">
									<div class="row">
										<div class="col-sm-6">
											<div class="price-box">
												<span class="price fa fa-inr">{{ number_format($main_product->seller_products[0]->seller_price, 2, '.', ',') }}</span>
												<span class="price-strike fa fa-inr">{{ number_format($main_product->original_price, 2, '.', ',') }}</span>
											</div>
										</div>
									</div>
								</div>

								<div class="quantity-container info-container">
									<div class="row">

										<div class="col-sm-2">
											<span class="label">Qty :</span>
										</div>

										<div class="col-sm-2">
											<div class="cart-quantity">
												<div class="quant-input">
													<div class="arrows">
														<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
														<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
													</div>
													<input type="text" value="1" seller-product-quantity disabled>
												</div>
											</div>
										</div>

										<div class="col-sm-8">
											<a href="#" seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary seller-product"><i class="fa fa-shopping-cart inner-right-vs"></i> Add to cart</a>
											<a href="checkout" class="btn btn-primary"><i class="fa fa-shopping-bag inner-right-vs"></i> Buy now</a>
										</div>
									</div>
								</div>

								@if(count($attributes) > 0 && count($main_product->seller_products[0]->attribute_values) > 0)
								<div class="quantity-container info-container">
									<div class="row">
										@foreach($attributes as $attribute)
										<div class="col-sm-4">
											<label>{{ $attribute->name }}</label>
											<select class="form-control" name="cat1" seller-product-option="{{ $attribute->name }}" required>
												@foreach($main_product->seller_products[0]->attribute_values as $attribute_value)
												@if($attribute->id == $attribute_value->attribute_id && $attribute_value->status == 'ACTIVE')
												<option>{{ $attribute_value->value }}</option>
												@endif
												@endforeach
											</select>
										</div>
										@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>

					<div class="product-tabs inner-bottom-xs  wow fadeInUp">
						<div class="row">
							<div class="col-sm-3">
								<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
									<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
									@if (strlen($main_product->description_image_url) > 5)
									<li><a data-toggle="tab" href="#description1">Image Description</a></li>
									@endif
									@if (strlen($main_product->description_video_url) > 5)
									<li><a data-toggle="tab" href="#description2">Video Description</a></li>
									@endif
								</ul>
							</div>
							<div class="col-sm-9">
								<div class="tab-content">
									<div id="description" class="tab-pane in active">
										<div class="product-tab">
											<p class="text">{{ $main_product->description_text }}</p>
										</div>	
									</div>

									@if (strlen($main_product->description_image_url) > 5)
									<div id="description1" class="tab-pane in ">
										<div class="product-tab">
											<img src="{{ $main_product->description_image_url }}">
										</div>	
									</div>
									@endif

									@if (strlen($main_product->description_video_url) > 5)
									<div id="description2" class="tab-pane in ">
										<div class="product-tab">
											<iframe width="100%" height="280" src="{{ $main_product->description_video_url }}" frameborder="0" allowfullscreen></iframe>
										</div>	
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					@if (count($related_products) > 0)
					<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
						<div class="more-info-tab clearfix ">
							<h3 class="new-product-title pull-left">Related Products</h3>
						</div>
						<div class="tab-content outer-top-xs">
							<div class="tab-pane in active" id="all">
								<div class="product-slider">
									<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
										@foreach($related_products as $product)
										<div class="item item-carousel">
											<div class="products">
												<div class="product">
													<div class="product-image">
														<div class="image"> 
															<a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">
																<img src="{{ $product->product_images[0]->url }}" alt="">
															</a> 
														</div>
													</div>
													<div class="product-info text-left">
														<h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ $product->display_name }}</a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>
														<div class="product-price"> <span class="price"><span class="fa fa-inr"></span>{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }} </span>
															<span class="price-before-discount"><span class="fa fa-inr"></span>{{ number_format($product->original_price, 2, '.', ',') }}</span> 
														</div>
													</div>

													<div class="cart clearfix animate-effect">
														<div class="action">
															<ul class="list-unstyled">
																<li class="add-cart-button btn-group">
																	<button seller-product-id="{{ $product->seller_products[0]->id }}" data-toggle="tooltip" class="btn btn-primary icon seller-product" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
																	<button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</button>
																</li>
																<li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="wishlist" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
																<li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="checkout" title="Buy now"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> </a> </li>
															</ul>
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
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function () {
    	$('.quant-input .arrows .arrow').click(function () {
    		var val = 0;
    		if (!isNaN($(this).parent().parent().find('input').val())) {
    			val = parseInt($(this).parent().parent().find('input').val());
    		}
    		if ($(this).hasClass('plus')) {
    			val++;
    		}
    		if ($(this).hasClass('minus')) {
    			if (val > 0) {
					val--;
				}
    		}
    		$(this).parent().parent().find('input').val(val);
    	});

        $('.seller-product').click(function () {
        	options = {};
        	if ($('input[seller-product-quantity]').length > 0) {
        	}

            window.location.href = '/store/cart/add/' + $(this).attr('seller-product-id');
        });
    });
</script>
@endsection