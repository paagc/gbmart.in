@extends('store.app')

@section('content')
<style>
    .products .image img {
        max-height: 200px;
    }
</style>

<div class="body-content outer-top-xs" id="top-banner-and-menu">
            <div class="container">
                <div class="row"> 
            
                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
                        
                            
                        <div class="side-menu animate-dropdown outer-bottom-xs">
                            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                            <nav class="yamm megamenu-horizontal">
                                <ul class="nav">

                                    @foreach($categories as $category)
                                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle text-uppercase" data-toggle="dropdown"><i class="icon fa {{ $category->fa_icon }}" aria-hidden="true"></i>{{ $category->display_name }}</a>
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <div class="row">
                                                    @for($i = 0; $i < count($category->sub_categories); $i += 3)
                                                    <div class="col-xs-12 col-sm-12 col-lg-4">
                                                        <ul>
                                                            @foreach($category->sub_categories as $index => $sub_category)
                                                            @if($index >= ($i * 3) && $index < (($i + 1) * 3))
                                                            <li><a href="/store/{{ $category->name }}/{{ $sub_category->name }}">{{ $sub_category->display_name }}</a></li>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </li>
                                        </ul>
                                     </li>
                                     @endforeach
                                </ul>
                            </nav>
                        </div>
                        
                        @if (count($hot_deal_products) > 0)
                        <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                            <h3 class="section-title">Hot deals</h3>
                            <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                                @foreach($hot_deal_products as $product)
                                <div class="item">
                                    <div class="products">
                                        <div class="hot-deal-wrapper">
                                            <div class="image custom-product-image"> <img src="{{ $product->product_images[0]->url }}" alt=""> </div>
                                            
                                            
                                        </div>
                                    
                                        
                                        <div class="product-info text-left m-t-20">
                                            <h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ (strlen($product->display_name) > 20 ? substr($product->display_name, 0, 15) . "..." : $product->display_name) }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price"> <span class="price"><span class="fa fa-inr"></span>{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }}</span> 
                                                
                                                <span class="price-before-discount"><span class="fa fa-inr"></span>{{ number_format($product->original_price, 2, '.', ',') }}</span> </div>
                                            
                                        </div>
                                        
                                        
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <div class="add-cart-button btn-group">
                                                    <button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary icon seller-product" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </buuton>
                                                    <button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</button>
                                                    <button seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn buy-now" type="button">Buy now</button>
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
                                        <div class="products special-product custom-product-boxes">
                                            @foreach($featured_products as $product)
                                            <div class="product custom-product-box">
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

                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
                        @if (count($home_slides) > 0)
                        <div id="hero">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                @foreach($home_slides as $home_slide)
                                <div class="item" style="background-image: url({{ $home_slide->image_url }});">
                                    <div class="container-fluid">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="info-boxes wow fadeInUp">
                            <div class="info-boxes-inner">
                                <div class="row">
                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">money back</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">30 Days Money Back Guarantee</h6>
                                        </div>
                                    </div>
                                    <div class="hidden-md col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">free shipping</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Shipping on orders over RS.99</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">Special Sale</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Extra Rs.5 off on all items </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (count($new_products) > 0)
                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-left">New Products</h3>
                            </div>
                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme custom-product-boxes" data-item="4">

                                            @foreach($new_products as $product)
                                            <div class="item item-carousel custom-product-box">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image custom-product-image"> <a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">
                                                                <img src="{{ $product->product_images[0]->url }}" alt=""></a> 
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ (strlen($product->display_name) > 20 ? substr($product->display_name, 0, 15) . "..." : $product->display_name) }}</a></h3>
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
                                                                        <a href="#" seller-product-id="{{ $product->seller_products[0]->id }}" data-toggle="tooltip" class="btn btn-primary icon seller-product" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </a>
                                                                        <a href="#" seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</a>
                                                                    </li>
                                                                    <li product-id="{{ $product->id }}" class="lnk wishlist add-wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    <li class="lnk"> <a seller-product-id="{{ $product->seller_products[0]->id }}" href="#" data-toggle="tooltip" class="add-to-cart buy-now" title="Buy now"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> </a> </li>
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
                        
                        @if (count($offers) > 0)
                        <div class="wide-banners wow fadeInUp outer-bottom-xs">
                            <div class="row">
                                @foreach($offers as $offer)
                                <div class="col-md-7 col-sm-7">
                                    <div class="wide-banner cnt-strip">
                                        <div class="image"> <img class="img-responsive" src="{{ $offer->image_url }}" alt=""> </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                
                        @if(count($bestseller_products) > 0)
                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-left">Best Seller</h3>
                            </div>
                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme custom-product-boxes" data-item="4">

                                            @foreach($bestseller_products as $product)
                                            <div class="item item-carousel custom-product-box">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image custom-product-image"> <a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">
                                                                <img src="{{ $product->product_images[0]->url }}" alt=""></a> 
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a href="/store/{{ $product->category->name }}/{{ $product->sub_category->name }}/{{ $product->name }}">{{ (strlen($product->display_name) > 20 ? substr($product->display_name, 0, 15) . "..." : $product->display_name) }}</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>
                                                            <div class="product-price"> 
                                                                <span class="price"><span class="fa fa-inr"></span>{{ number_format($product->seller_products[0]->seller_price, 2, '.', ',') }} </span>
                                                                <span class="price-before-discount"><span class="fa fa-inr"></span>{{ number_format($product->original_price, 2, '.', ',') }}</span> 
                                                            </div>
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <a href="#" seller-product-id="{{ $product->seller_products[0]->id }}" data-toggle="tooltip" class="btn btn-primary icon seller-product" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </a>
                                                                        <a href="#" seller-product-id="{{ $product->seller_products[0]->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</a>
                                                                    </li>
                                                                    <li class="lnk wishlist add"> 
                                                                        <a product-id="{{ $product->id }}" data-toggle="tooltip" class="add-to-cart add-wishlist" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                                                                    </li>
                                                                    <li class="lnk"> 
                                                                        <a  seller-product-id="{{ $product->seller_products[0]->id }}" data-toggle="tooltip" class="add-to-cart buy-now" href="#" title="Buy now"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> </a> 
                                                                    </li>
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

        $('.buy-now').click(function () {
            window.location.href = '/store/cart/buy-now/' + $(this).attr('seller-product-id');
        });

        $('.add-wishlist').click(function () {
            window.location.href = '/store/wishlist/add/' + $(this).attr('product-id');
        });
    });
</script>
@endsection