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
                                            {{--<button class="btn btn-primary pull-right">Add New Address</button>--}}
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
                                                            @if($address->status!='ACTIVE')
                                                                <a href="{{url("address/set-active/{$address->id}")}}"
                                                                   class="btn btn-xs btn-success">Set Default</a>

                                                                <form class="delete-address"
                                                                      action="{{url("address/{$address->id}")}}"
                                                                      method="post">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button class="btn btn-xs btn-danger"
                                                                            onclick="deleteAddress({{$address->id}});">
                                                                        Delete
                                                                    </button>
                                                                </form>

                                                            @endif
                                                            <button class="btn btn-xs btn-info"
                                                                    onclick="editAddress({{$address->id}});">Edit
                                                            </button>
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



    <div id="edit-address" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Address</h4>
                </div>
                <div class="modal-body">
                    <p class="text-info">
                        Note: This update of address is applicable for your next orders.
                        This won't affect orders which are yet be delivered.
                    </p>
                    <form id="edit-address-form" action="#" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="line_1">Line One *</label>
                            <input type="text" class="form-control" name="line_1" required id="line_1">
                        </div>
                        <div class="form-group">
                            <label for="line_2">Line Two *</label>
                            <input type="text" class="form-control" name="line_2" required id="line_2">
                        </div>
                        <div class="form-group">
                            <label for="city_town">City *</label>
                            <input type="text" class="form-control" name="city_town" required id="city_town">
                        </div>
                        <div class="form-group">
                            <label for="state">State *</label>
                            <input type="text" class="form-control" name="state" required id="state">
                        </div>
                        <div class="form-group">
                            <label for="pin_code">Pic Code *</label>
                            <input type="text" class="form-control" name="pin_code" required id="pin_code">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <script>
                @php
                    $addressesFormatted = $addresses->map(function ($address) {
                        return [$address->id => $address];
                        });
                @endphp
        var addresses ={!! json_encode($addressesFormatted[0]) !!};


        function editAddress(id) {
            var sendTo = '{{url("address")}}/' + id;
            $("#edit-address-form").attr('action', sendTo);
            $('#line_1').val(addresses[id].line_1);
            $('#line_2').val(addresses[id].line_2);
            $('#city_town').val(addresses[id].city_town);
            $('#state').val(addresses[id].state);
            $('#pin_code').val(addresses[id].pin_code);
            $("#edit-address").modal('show');
        }

        $(document).ready(function () {
            $(".delete-address").on('submit', function () {
                return confirm('Are you sure want to delete this address? (this wont affect any orders on the way!!)') === true;
            })
        })

    </script>

@endsection