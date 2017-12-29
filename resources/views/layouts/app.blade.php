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


    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/blue.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/rateit.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">


    <link rel="stylesheet" href="/assets/css/font-awesome.css">


    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="cnt-home">
@include('sweet::alert')
<header class="header-style-1">


    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a><i class="fa fa-phone"></i>(+91)8467-896-789</a></li>
                        <li><a><i class="fa fa-envelope"></i>support@gbmart.in</a></li>
                        <li><a href="/seller/register"><i class="fa fa-users"></i>Be a seller</a></li>
                        <li><a href="account"><i class="icon fa fa-user"></i>My Account</a></li>
                        <li><a href="wishlist"><i class="icon fa fa-heart"></i>Wishlist</a></li>

                        <li><a href="checkout"><i class="icon fa fa-check"></i>Checkout</a></li>
                        <li><a href="track"><i class="icon fa fa-thumb-tack"></i>Track Your Order</a></li>
                        <li style="color:white;">Welcome, Ajay</li>

                        <li><a href="login"><i class="icon fa fa-lock"></i>Login/Register</a></li>
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

                    <div class="logo"><a href="/"> <img src="/assets/images/logo.png" alt="logo"> </a></div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">

                    <div class="search-area">
                        <form>
                            <div class="control-group">

                                <input class="search-field" placeholder="Search here..."/>
                                <a class="search-button" href="#"></a></div>
                        </form>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">


                    <div class="dropdown dropdown-cart"><a href="#" class="dropdown-toggle lnk-cart"
                                                           data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                                <div class="basket-item-count"><span class="count">2</span></div>
                                <div class="total-price-basket"><span class="lbl">cart -</span> <span
                                            class="total-price"><span class="fa fa-inr"></span>600.00</span></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"><a href="detail"><img src="/assets/images/cart.jpg"
                                                                                     alt=""></a></div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="detail">Product Name</a></h3>
                                            <div class="price"><span class="fa fa-inr"></span>600.00</div>
                                        </div>
                                        <div class="col-xs-1 action"><a href="#"><i class="fa fa-trash"></i></a></div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"><span class="text">Sub Total :</span><span
                                                class='price'><span class="fa fa-inr"></span>600.00</span></div>
                                    <div class="clearfix"></div>
                                    <a href="checkout" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                    <a href="cart" class="btn btn-upper btn-primary btn-block m-t-20">Cart</a>
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
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">ELECTRONICS</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">APPLIANCES</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">MEN</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">WOMEN</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">BABY & KIDS</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">HOME & FURNITURE</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">BOOKS & MORE</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="subcat">Cat 1</a></li>
                                                            <li><a href="subcat">Cat 2</a></li>
                                                            <li><a href="subcat">Cat 3</a></li>
                                                            <li><a href="subcat">Cat 4</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>


                                <li class="dropdown  navbar-right special-menu"><a href="subcat">Todays offer</a></li>
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
                        <p style="font-size:14px;color:grey">Gbmart.in is India's startup growing multi-category online
                            shopping store,
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
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <p>Old kautha road, nanded, Maharashtra – 431603.</p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <p>(+91)8467-896-789</p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body"><span><a href="#">support@gbmart.in</a></span></div>
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
                            <li><a href="about">About Us</a></li>
                            <li><a href="write">Write To us</a></li>
                            <li><a href="terms">Terms And Condition</a></li>
                        </ul>
                    </div>

                </div>


                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Our Policy</h4>
                    </div>


                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="privacy">Privacy</a></li>
                            <li><a href="cancel">Cancellation</a></li>
                            <li><a href="disclaimer">Disclaimer</a></li>
                            <li><a href="return">Return And Refund</a></li>
                            <li><a href="ship">Shipping And Delivery</a></li>
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

</body>


</html>