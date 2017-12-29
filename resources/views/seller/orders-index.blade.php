@extends('seller.app')

@section('content_header')
    <h1>
        Pending Orders
    </h1>
    <ol class="breadcrumb">
        <li><a href="/seller">Home</a></li>
        <li><a href="/orders">Orders</a></li>
        <li class="active">Pending Orders</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="/seller/orders/pending" method="GET">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Product</th>
                                <th>Count</th>
                                <th>Price</th>
                                <th>Delivery Charge</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Placed At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->seller_product->product->name }}</td>
                                    <td>{{ $order->count }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->delivery_charge }}</td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ date('d-m-y h:i:sa', strtotime($order->created_at) + 19800)}}</td>
                                    <td class="text-center"><a class="btn btn-xs show-detail"
                                                               order-id="{{ $order->id }}"><i
                                                    class="fa fa-arrow-down"></i></a></td>
                                </tr>
                                <tr class="order-detail hide" order-id="{{ $order->id }}">
                                    <td colspan="9">
                                        <div class="box box-solid">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <dl>
                                                            <dt>Order #</dt>
                                                            <dd>{{ $order->id }}</dd>
                                                            <dt>Order Date & Time</dt>
                                                            <dd>{{ date('d-m-y h:i:sa', strtotime($order->created_at) + 19800)}}</dd>
                                                            <dt>Product</dt>
                                                            <dd>{{ $order->product->name }}</dd>
                                                            <dt>Payment Method</dt>
                                                            <dd>{{ $order->payment_method }}</dd>
                                                            <dt>Payment Ref. #</dt>
                                                            <dd>{{ $order->payment_reference }}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <dl>
                                                            <dt>Order Status</dt>
                                                            <dd style="color: #0016a8; font-weight: 700;">
                                                                {{ $order->status }}
                                                            </dd>
                                                            <dt>Quantity</dt>
                                                            <dd>{{ $order->count }}</dd>
                                                            <dt>Price</dt>
                                                            <dd>Rs {{ $order->price }}</dd>
                                                            <dt>Delivery Charge</dt>
                                                            <dd>Rs {{ $order->delivery_charge }}</dd>
                                                            <dt>Total Amount</dt>
                                                            <dd>Rs {{ $order->total_amount }}</dd>
                                                            <dt>Expected Delivery</dt>
                                                            <dd>{{ $order->expected_delivery }}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <dl>
                                                            <dt>Extra Detail</dt>
                                                            <dd>{{ $order->extra }}</dd>
                                                            <dt>Customer Name</dt>
                                                            <dd>{{ $order->customer->name }}</dd>
                                                            <dt>Customer Mobile Number</dt>
                                                            <dd>{{ $order->customer->mobile_number }}</dd>
                                                            <dt>Shipping Address</dt>
                                                            <dd>{{ $order->address }}</dd>
                                                            <dt>Shipping City/Town</dt>
                                                            <dd>{{ $order->city }}</dd>
                                                            <dt>Shipping State</dt>
                                                            <dd>{{ $order->state }}</dd>
                                                            <dt>Shipping PIN Code</dt>
                                                            <dd>{{ $order->postal_code }}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Order Log</h4>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Date & Time</th>
                                                                <th>Remarks</th>
                                                            </tr>
                                                            @foreach($order->order_logs()->orderBy('created_at', 'desc')->get() as $log)
                                                                <tr>
                                                                    <td>{{ $log->status }}</td>
                                                                    <td>{{ date('d-m-y h:i:sa', strtotime($log->created_at) + 19800) }}</td>
                                                                    <td>{{ $log->remarks }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn pull-right hide-detail"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        @if($order->status == 'PENDING')
                                                            <button type="button"
                                                                    class="btn btn-success pull-right change-status"
                                                                    order-id="{{ $order->id }}" status="approved">Mark
                                                                as Approved
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-danger pull-right change-status"
                                                                    order-id="{{ $order->id }}" status="rejected">Mark
                                                                as Rejected
                                                            </button>
                                                        @elseif($order->status == 'APPROVED')
                                                            <div style="width: 200px; font-size: 14px!important;">
                                                                <label style="width: 200px" for="">Expected Delivery
                                                                    Date</label>
                                                                <input style="width: 200px" type="date"
                                                                       id="expected_delivery">
                                                            </div>

                                                            <button type="button"
                                                                    class="btn btn-success pull-right change-status"
                                                                    order-id="{{ $order->id }}" status="packed">Mark as
                                                                Packed
                                                            </button>
                                                        @elseif($order->status == 'PACKED')
                                                            <button type="button"
                                                                    class="btn btn-success pull-right change-status"
                                                                    order-id="{{ $order->id }}" status="shipped">Mark as
                                                                Shipped
                                                            </button>
                                                        @elseif($order->status == 'SHIPPED')
                                                            <button type="button"
                                                                    class="btn btn-success pull-right change-status"
                                                                    order-id="{{ $order->id }}" status="delivered">Mark
                                                                as Delivered
                                                            </button>
                                                        @endif
                                                        @if($order->status == 'PENDING' || $order->status == 'APPROVED' || $order->status == 'PACKED' || $order->status == 'SHIPPED')
                                                            <div class="row">
                                                                <div class="col-md-4 pull-right">
                                                                    <textarea name="" id="" style="max-width: 340px"
                                                                              class="form-control order-remarks"
                                                                              placeholder="Remarks..." cols="30"
                                                                              rows="3"></textarea>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Orders Available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    {{ $orders->appends(app('request')->all())->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('.show-detail').click(function () {
                $('tr.order-detail').addClass('hide');
                var orderId = $(this).attr('order-id');
                $('tr.order-detail[order-id="' + orderId + '"]').removeClass('hide');
            });
            $('.hide-detail').click(function () {
                $('tr.order-detail').addClass('hide');
            });
            $('.change-status').click(function () {
                var orderId = $(this).attr('order-id');
                var status = $(this).attr('status');
                var url = "/seller/orders/id/" + orderId + "/status-update/" + status;
                var remarks = $('input.order-remarks').val();


                if (remarks && remarks.length > 4) {
                    url += '?remarks=' + encodeURI(remarks);
                    if (status == 'packed') {
                        if (!$("#expected_delivery").val()) {
                            alert('Please Select Expected Delivery Date');
                            return false;
                        } else {
                            url += '&expected_delivery=' + encodeURI($("#expected_delivery").val())
                        }
                    }
                } else {
                    if (status == 'packed') {
                        if (!$("#expected_delivery").val()) {
                            alert('Please Select Expected Delivery Date');
                            return false;
                        } else {
                            url += '?expected_delivery=' + encodeURI($("#expected_delivery").val())
                        }
                    }
                }

                window.location.href = url;
            });
        });
    </script>
@endsection