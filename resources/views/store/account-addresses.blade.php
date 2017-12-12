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
                                    <li><a href="/store/my-account/password">Change Password</a></li>
                                    <li class="active"><a href="{{url('store/my-account/addresses')}}">Addresses</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        Line 1
                                                    </th>
                                                    <th>
                                                        Line 2
                                                    </th>
                                                    <th>
                                                        City
                                                    </th>
                                                    <th>
                                                        State
                                                    </th>
                                                    <th>
                                                        Pin code
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($addresses as $address)
                                                    <tr>
                                                        <td>{{$address->line_1}}</td>
                                                        <td>{{$address->line_2}}</td>
                                                        <td>{{$address->city_town}}</td>
                                                        <td>{{$address->state}}</td>
                                                        <td>{{$address->pin_code}}</td>
                                                        <td>
                                                            @if($address->status=='ACTIVE')
                                                                Default Address
                                                            @endif
                                                        </td>
                                                        <td>
                                                           {{-- if($address->status!='ACTIVE')
                                                                <button class="btn btn-xs btn-success">Set Default
                                                                </button>
                                                                <button class="btn btn-xs btn-danger"
                                                                        onclick="deleteAddress({{$address->id}});">
                                                                    Delete
                                                                </button>
                                                            endif
                                                            <button class="btn btn-xs btn-info"
                                                                    onclick="editAddress({{$address->id}});">Edit
                                                            </button>--}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

    <script>
        var addresses ={!! $addresses !!};


        function editAddress(id) {
alert('Work In Progress');
        }

    </script>

@endsection