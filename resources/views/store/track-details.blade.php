@extends('store.app')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Track Order Details</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="terms-conditions-page">
                <div class="row">
                    <div class="col-md-12 terms-conditions">
                        <h2 class="heading-title">Track Order Details</h2>
                        <div class="">


                            <center><h3>Order ID.:- {{$order->id}}</h3></center>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>{{$order->customer->name}}</th>
                                    <th>Contact Number</th>
                                    <th>{{$order->customer->mobile_number}}</th>
                                </tr>
                                <tr>
                                    <th>Order Placed Date</th>
                                    <th>{{$order->created_at->format('d-m-Y H:i a')}}</th>
                                    <th>Expected Delivery</th>
                                    <th>{{$order->expected_delivery}}</th>
                                </tr>
                                <tr>
                                    <th>Seller Name</th>
                                    <th>{{$order->seller_product->seller->name}}</th>
                                    <th>Delivery Location</th>
                                    <th>{{$order->city}}</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->order_logs as $log)
                                    <tr>
                                        <td>{{$log->created_at->format('d-m-Y H:i a')}}</td>
                                        <td>{{$log->status}}</td>
                                        <td>{{$log->remarks}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
@endsection