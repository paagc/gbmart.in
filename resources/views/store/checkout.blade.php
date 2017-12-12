@extends('store.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <form action="/store/checkout" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="payment_reference" value="{{ $payment_reference }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group checkout-steps">
                                <div class="panel panel-default checkout-step-03">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a href="#">
                                                <span>1</span>Shipping Information
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <h5>Existing Addresses</h5>
                                                @foreach($addresses as $address)
                                                    @if($address->status == 'ACTIVE')
                                                        <div class="col-md-12">
                                                            <div class="radio">
                                                                <input type="radio" name="address"
                                                                       value="{{ $address->id }}">
                                                                <label>{{ $address->line_1 . ", " . $address->line_2 . ", " . $address->city_town . ", " . $address->state .  ", " . $address->pin_code }}</label>
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<a address-id="{{ $address->id }}"
                                                           href="javascript: return null;" class="delete-address"
                                                           style="color: #ff0000; weight: 600;"><i
                                                                    class="fa fa-close"></i></a>
													</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="col-md-12">
                                                    <div class="radio">
                                                        <input type="radio" name="address" value="new">
                                                        <label>New address ?</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="new_address[line_1]"
                                                               class="form-control" placeholder="Line 1">
                                                    </div>
                                                    @if($errors->has('new_address.line_1'))
                                                        @foreach($errors->get('new_address.line_1') as $message)
                                                            <p style="color: #ff0000;">{{ $message }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="new_address[line_2]"
                                                               class="form-control" placeholder="Line 2">
                                                    </div>
                                                    @if($errors->has('new_address.line_2'))
                                                        @foreach($errors->get('new_address.line_2') as $message)
                                                            <p style="color: #ff0000;">{{ $message }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" name="new_address[city_town]"
                                                               class="form-control" placeholder="City/Town">
                                                    </div>
                                                    @if($errors->has('new_address.city_town'))
                                                        @foreach($errors->get('new_address.city_town') as $message)
                                                            <p style="color: #ff0000;">{{ $message }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" name="new_address[state]"
                                                               class="form-control" placeholder="State">
                                                    </div>
                                                    @if($errors->has('new_address.state'))
                                                        @foreach($errors->get('new_address.state') as $message)
                                                            <p style="color: #ff0000;">{{ $message }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" name="new_address[pin_code]"
                                                               class="form-control" placeholder="PIN Code">
                                                    </div>
                                                    @if($errors->has('new_address.pin_code'))
                                                        @foreach($errors->get('new_address.pin_code') as $message)
                                                            <p style="color: #ff0000;">{{ $message }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                @if($errors->has('address'))
                                                    @foreach($errors->get('address') as $message)
                                                        <p style="color: #ff0000;">{{ $message }}</p>
                                                    @endforeach
                                                @endif
                                                @if($errors->has('new_address'))
                                                    @foreach($errors->get('new_address') as $message)
                                                        <p style="color: #ff0000;">{{ $message }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default checkout-step-06">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a href="#">
                                                <span>2</span>Payment method
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">
                                                    Select your Payment Method
                                                </h4>
                                            </div>
                                            <?php
                                            $is_cod_option_available = false;
                                            foreach ($cart_items as $index => $item) {
                                                if ($item['seller_product']->is_cod_available) {
                                                    $is_cod_option_available = true;
                                                }
                                            }
                                            ?>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @if($is_cod_option_available)
                                                            <div class="col-md-12">
                                                                <div class="radio">
                                                                    <input type="radio" name="payment_method"
                                                                           value="COD">
                                                                    <label> Cash on delivery (COD)</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-12">
                                                            <div class="radio">
                                                                <input type="radio" name="payment_method" value="ONLINE"
                                                                       @if(!$is_cod_option_available) checked @endif>
                                                                <label> Card Payment / Internet Banking /
                                                                    Wallets</label>
                                                            </div>
                                                        </div>
                                                        @if($errors->has('payment_method'))
                                                            @foreach($errors->get('payment_method') as $message)
                                                                <p style="color: #ff0000;">{{ $message }}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default checkout-step-06">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a href="#">
                                                <span>3</span>Order Review
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="body-content outer-top-xs">
                                                <div>
                                                    <div class="row">
                                                        <div class="shopping-cart">
                                                            <div class="shopping-cart-table ">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="cart-romove item">Remove</th>
                                                                            <th class="cart-description item">Image</th>
                                                                            <th class="cart-product-name item">Product
                                                                                Name
                                                                            </th>
                                                                            <th class="cart-qty item">Quantity</th>
                                                                            <th class="cart-sub-total item">Shipping
                                                                            </th>
                                                                            <th class="cart-total last-item">Grand
                                                                                Total
                                                                            </th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                        @foreach($cart_items as $index => $item)


                                                                            <tr>
                                                                                <td class="romove-item"><a href="/store/cart/remove/{{ $item['rowId'] }}"
                                                                                                           title="cancel" class="icon"><i
                                                                                                class="fa fa-trash-o"></i></a></td>
                                                                                <td class="cart-image">
                                                                                    <a class="entry-thumbnail"
                                                                                       href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}-{{ $item['seller_product']->id }}">
                                                                                        <img src="{{ $item['seller_product']->product->product_images[0]->url }}"
                                                                                             alt="">
                                                                                    </a>
                                                                                </td>
                                                                                <td class="cart-product-name-info">
                                                                                    <h4 class='cart-product-description'>
                                                                                        <a href="/store/{{ $item['seller_product']->product->category->name }}/{{ $item['seller_product']->product->sub_category->name }}/{{ $item['seller_product']->product->name }}-{{ $item['seller_product']->id }}">{{ $item['seller_product']->product->display_name }}</a>
                                                                                    </h4>
                                                                                </td>
                                                                                <td class="cart-product-quantity">
                                                                                    <div class="cart-quantity">

                                                                                        <input width="40" id="qtyInput{{ $index + 1 }}" style="width: 60px"
                                                                                               type="number" min="1"
                                                                                               value="{{$item['quantity']}}">
                                                                                        <button type="button"
                                                                                                onclick="updateCart('{{$item['rowId']}}','qtyInput{{ $index + 1 }}');">
                                                                                            update
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="cart-product-sub-total"><span
                                                                                            class="cart-sub-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'], 2, '.', ',') }}</span>
                                                                                </td>
                                                                                <td class="cart-product-grand-total">
                                                                                    <span class="cart-grand-total-price">RS. {{ number_format($item['seller_product']->seller_price * $item['quantity'] + $item['seller_product']->delivery_charge, 2, '.', ',') }}</span>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <center>
                                                                <div class="col-md-4 col-sm-12 cart-shopping-total">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <div class="cart-sub-total">
                                                                                    Sub Total<span
                                                                                            class="inner-left-md fa fa-inr">{{ number_format($subtotal, 2, '.', ',') }}</span>
                                                                                </div>
                                                                                <div class="cart-grand-total">
                                                                                    Grand Total<span
                                                                                            class="inner-left-md fa fa-inr">{{ number_format($total, 2, '.', ',') }}</span>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </center>
                                                            @if(Session::has('payment_type_mismatch_seller_products') && is_array(Session::get('payment_type_mismatch_seller_products')) && count(Session::get('payment_type_mismatch_seller_products')) > 0)
                                                                <div class="col-md-12">
                                                                    <h3>These product(s) are not available for the
                                                                        select payment option.</h3>
                                                                    @foreach(Session::get('payment_type_mismatch_seller_products') as $seller_product)
                                                                        <p>{{ $seller_product['seller_product']->product->display_name }}
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                                                    href="/store/cart/remove/{{ $seller_product['rowId'] }}"
                                                                                    style="color: #ff0000; font-size: 12px;">
                                                                                Remove</a></p>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <div class="cart-checkout-btn pull-right">
                                                                <button type="submit"
                                                                        class="btn btn-primary checkout-btn">Place Order
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('.delete-address').click(function () {
                var id = $(this).attr('address-id');
                window.location.href = "/store/checkout/delete-address/" + id;
            });
        });
        function updateCart(rowId, id) {
            qty = parseInt(document.getElementById(id).value);
            window.location.href='{{url('store/update-cart?rowId=')}}'+rowId+'&qty='+qty;
        }
    </script>
@endsection