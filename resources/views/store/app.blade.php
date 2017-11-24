<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>GB Mart|Best Online Shopping Mart|Best In Maharashtra</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

<meta name="google-site-verification" content="Y0bUWQUbv6K23ztk31iZztpukWQSGX5Nkr2F8Z5j2W0" />
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/blue.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/lightbox.css">
    <link rel="stylesheet" href="/assets/css/rateit.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">


    <link rel="stylesheet" href="/assets/css/font-awesome.css">


    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
    .custom-product-image {
        display: flex;
    }
    .custom-product-image a {
        margin: auto;
    }
    .custom-product-image img {
        margin: auto;
    }
    </style>
</head>
<body class="cnt-home">

    <header class="header-style-1"> 


        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            <li><a href="tel:+918055623322" style="text-decoration: none;"><i class="fa fa-phone"></i>(+91) 8055-623-322</a></li>
                            <li><a><i class="fa fa-envelope"></i>support@gbmart.in</a></li>
                            <li><a href="/seller/register"><i class="fa fa-users"></i>Be a seller</a></li>

                            @if (Auth::check() && Auth::user() && Auth::user()->type == 'customer')
                            <li><a href="/store/my-account"><i class="icon fa fa-user"></i>My Account</a></li>
                            <li><a href="/store/wishlist"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                            <li><a href="/store/checkout"><i class="icon fa fa-check"></i>Checkout</a></li>
                            <li><a href="/track"><i class="icon fa fa-thumb-tack"></i>Track Your Order</a></li>
                            <li style="color:white;">Welcome, {{ Auth::user()->name }} </li>
                            <li><a href="/logout"><i class="icon fa fa-sign-out"></i>Log out</a></li>
                            @else
                            <li><a href="/store/checkout"><i class="icon fa fa-check"></i>Checkout</a></li>
                            <li><a href="/login"><i class="icon fa fa-lock"></i>Login/Register</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 

                        <div class="logo"> <a href="/"> <img src="/assets/images/logo.png" alt="logo"> </a> </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder"> 

                        <div class="search-area">
                            <form>
                                <div class="control-group">

                                    <input class="search-field" placeholder="Search here..." />
                                    <a class="search-button" href="#" ></a> 
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                        <div class="dropdown dropdown-cart"> 
                            <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                                <div class="items-cart-inner">
                                    <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                    <div class="basket-item-count"><span class="count">{{ Cart::count() }}</span></div>
                                    <div class="total-price-basket"> 
                                        <span class="lbl">cart -</span> <span class="total-price"><span class="fa fa-inr"></span>{{ Cart::subtotal() }}</span>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="cart-item product-summary">
                                        <?php
                                        $subtotal = 0;
                                        $total = 0;

                                        $cart_items = [];
                                        foreach(Cart::content()  as $item) {
                                            $seller_product = \App\SellerProduct::find($item->id);
                                            if (!is_null($seller_product)) {
                                                array_push($cart_items, [
                                                    'rowId' => $item->rowId,
                                                    'seller_product' => $seller_product,
                                                    'quantity' => $item->qty,
                                                    'options' => $item->options
                                                ]);
                                                $subtotal += $item->qty * $seller_product->seller_price;
                                                $total += $item->qty * $seller_product->seller_price + $seller_product->delivery_charge;
                                            }
                                        }
                                        ?>
                                        @foreach($cart_items as $item)
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image"><img src="{{ $item['seller_product']->product->product_images[0]->url }}" alt=""></div>
                                            </div>
                                            <div class="col-xs-7">
                                                <h3 class="name"><span style="font-weight: 600;">{{ substr($item['seller_product']->product->name, 0, 10) . "..." }}</span> x <span style="font-weight: 600;">{{ $item['quantity'] }}</span></h3>
                                                @foreach($item['options']->all() as $key => $attr)
                                                <span style="font-size: 11px; "><span style="text-decoration: capitalize;">{{ $key }}</span>: {{ $attr }}</span>
                                                @endforeach
                                                <div class="price"><span class="fa fa-inr"></span>{{ $item['seller_product']->seller_price }}</div>
                                            </div>
                                            <div class="col-xs-1 action"> <a href="/store/cart/remove/{{ $item['rowId'] }}"><i class="fa fa-trash"></i></a> </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="clearfix cart-total">
                                        <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'><span class="fa fa-inr"></span>{{ $subtotal }}</span> </div>
                                        <div class="clearfix"></div>
                                        <a href="/store/checkout" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> 
                                        <a href="/store/cart" class="btn btn-upper btn-primary btn-block m-t-20">Cart</a> 
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
                            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div class="nav-bg-class">
                            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                                <div class="nav-outer">
                                    <ul class="nav navbar-nav">
                                        @foreach(\App\Category::with(['sub_categories' => function($query) { $query->where('status', 'ACTIVE')->orderBy('id', 'asc'); }])->whereHas('sub_categories', function ($query) { $query->where('status', 'ACTIVE'); })->where('status', 'ACTIVE')->orderBy('id', 'asc')->get() as $index => $category)

                                        @if($index < 10)
                                        <li class="dropdown"> <a href="#" class="dropdown-toggle text-uppercase" data-hover="dropdown" data-toggle="dropdown">{{ $category->display_name }}</a>
                                            @if(count($category->sub_categories) > 0)
                                            <ul class="dropdown-menu pages">
                                                <li>
                                                    <div class="yamm-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-menu">
                                                                <ul class="links">
                                                                    @foreach($category->sub_categories as $sub_category)
                                                                    <li><a href="/store/{{ $category->name }}/{{ $sub_category->name }}">{{ $sub_category->display_name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif
                                        </li>
                                        @endif
                                        @endforeach

                                        <!-- <li class="dropdown  navbar-right special-menu"><a href="subcat">Todays offer</a></li> -->
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>


            </div>


        </header>


        @yield('content')

        <footer id="footer" class="footer color-bg">
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div>
                                <img src="/assets/images/logo.png" alt="logo">

                                <br><br>
                                <p style="font-size:14px;color:grey">Gbmart.in is India's startup growing multi-category online shopping store, 
                                    offering various advantages to its customers ranging from quality of items to timely 
                                delivery of the products. </p>
                            </div>




                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="module-heading">
                                <h4 class="module-title">Contact Us</h4>
                            </div>

                            <div class="module-body">
                                <ul class="toggle-footer" style="">
                                    <li class="media">
                                        <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                        <div class="media-body">
                                            <p>Old kautha road, nanded, Maharashtra – 431603.</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                        <div class="media-body">
                                            <p><a href="tel:+918055623322" style="text-decoration: none;">(+91) 8055-623-322</a></p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                        <div class="media-body"> <span><a href="#">support@gbmart.in</a></span> </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="module-heading">
                                <h4 class="module-title">Information</h4>
                            </div>


                            <div class="module-body">
                                <ul class='list-unstyled'>
                                    <li><a href="/about-us">About Us</a></li>
                                    <li><a href="/write-to-us">Write To us</a></li>
                                    <li><a href="/terms-and-conditions">Terms And Condition</a></li>
                                </ul>
                            </div>

                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="module-heading">
                                <h4 class="module-title">Our Policy</h4>
                            </div>


                            <div class="module-body">
                                <ul class='list-unstyled'>
                                    <li><a href="/privacy">Privacy</a></li>
                                    <li><a href="/cancellation">Cancellation</a></li>
                                    <li><a href="/disclaimer">Disclaimer</a></li>
                                    <li><a href="/return-and-refund">Return And Refund</a></li>
                                    <li><a href="/shipping-and-delivery">Shipping And Delivery</a></li>
                                </ul>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="copyright-bar">
                <div class="container">
                    <div class="col-xs-12 col-sm-6 no-padding social">
                        <span style="color:grey">Copyright @<a href="/"><span>GBMart.in</span></a>2017.All rights reserved.
                        Powered by :<a href="http://paagcdigital.com/" target="blank"><span>Paagc Digital Pvt.Ltd.</span> </span></a>
                    </div>
                    <div class="col-xs-12 col-sm-6 no-padding">
                        <div class="clearfix payment-methods">
                            <img src="/assets/images/payment.png" alt="logo">
                        </div>

                    </div>
                </div>
            </div>
        </footer>

        <script src="/assets/js/jquery-1.11.1.min.js"></script> 
        <script src="/assets/js/bootstrap.min.js"></script> 
        <script src="/assets/js/bootstrap-hover-dropdown.min.js"></script> 
        <script src="/assets/js/owl.carousel.min.js"></script> 
        <script src="/assets/js/echo.min.js"></script> 
        <script src="/assets/js/jquery.easing-1.3.min.js"></script> 
        <script src="/assets/js/bootstrap-slider.min.js"></script> 
        <script src="/assets/js/jquery.rateit.min.js"></script> 
        <script type="text/javascript" src="/assets/js/lightbox.min.js"></script> 
        <script src="/assets/js/bootstrap-select.min.js"></script> 
        <script src="/assets/js/wow.min.js"></script> 
        <script src="/assets/js/scripts.js"></script>
        @yield('footer')
        <script>
            function setProductSizes() {
                $('.custom-product-image').each(function () {
                    var w = parseInt($(this).width());
                    $(this).css('height', w);
                    var img_h = parseInt($(this).find('img').height());
                    var img_w = parseInt($(this).find('img').width());
                    if (img_w >= img_h) {
                        $(this).find('img').css('width', w);
                        $(this).find('img').css('heigth', parseInt(w * (parseFloat(img_h) / parseFloat(img_w))));
                    } else {
                        $(this).find('img').css('height', w);
                        $(this).find('img').css('width', parseInt(w * (parseFloat(img_h) / parseFloat(img_w))));
                    }
                });

                $('.custom-product-boxes').each(function () {
                    var max_h = 0;
                    $(this).find('.custom-product-box').each(function () {
                        var h = parseInt($(this).height());
                        if (h > max_h) {
                            max_h = h;
                        }
                    });
                    $(this).find('.custom-product-box').css('height', max_h);
                });
            }

            $(window).load(setProductSizes);
            $(window).resize(setProductSizes);
        </script>
    </body>


    </html>