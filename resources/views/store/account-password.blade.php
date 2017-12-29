@extends('store.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Home</a></li>

                    <li class='active'>My Account</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>


                <div class='col-md-12'>


                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li><a href="/store/my-account/orders">My Orders</a></li>
                                    <li><a href="/store/my-account/user">Account Settings</a></li>
                                    <li class="active"><a href="/store/my-account/password">Change Password</a></li>
                                    <li><a href="{{url('store/my-account/addresses')}}">Addresses</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="tags" class="tab-pane in active">
                                        <div class="product-tag">

                                            <div class="review-form">
                                                <div class="form-container">
                                                    <form action="{{url('store/my-account/change-password')}}"
                                                          method="post">
                                                        {{ csrf_field() }}
                                                        <div class="row">

                                                            <div class="col-sm-12">
                                                                @if(\Session::has('message'))
                                                                    <div class="alert alert-{{\Session::get('class')}}">
                                                                        <strong>{{\Session::get('message')}}</strong>
                                                                    </div>
                                                                    {{\Session::forget(['message','message_type'])}}
                                                                @endif
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Old Password <span
                                                                                    class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                               id="exampleInputName" name="old_password"
                                                                               placeholder="">
                                                                    </div>
                                                                </div><!-- /.form-group -->
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">New Password <span
                                                                                    class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                               id="exampleInputName" name="new_password"
                                                                               placeholder="">
                                                                    </div>
                                                                </div><!-- /.form-group -->
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Conform New
                                                                            Password <span class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                               id="exampleInputName"
                                                                               name="new_password_confirm"
                                                                               placeholder="">
                                                                    </div>
                                                                </div><!-- /.form-group -->
                                                            </div>


                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper">Update Password
                                                            </button>
                                                        </div><!-- /.action -->
                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                            </div><!-- /.review-form -->
                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->
                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item m-t-10">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->
                    </div><!-- /.owl-carousel #logo-slider -->
                </div><!-- /.logo-slider-inner -->

            </div><!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection