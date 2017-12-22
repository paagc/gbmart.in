<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>


</style>


<body>


<div class="col-lg-12 " style="padding-left:0px; padding-right:0px;">


    <a href="https://gbmart.in/" target="blank"><img src="{{url('assets/images/logo.png')}}" class="col-lg-12 col-xs-12"
                                                     style="padding-left:0px; padding-right:0px;"></a>

</div>

<div class="col-lg-offset-1 col-lg-10" style="background-color:#DADCDE; padding-left:0px; padding-right:0px;">
    <div class="col-lg-12" style="padding-left:0px; padding-right:0px;">

        <center>
            <h1> Order Confirmed</h1>
            <h3>Order ID: <span style="color:blue;">{{$payment_reference}}</span></h3>
        </center>

    </div>

    {{--<div class="col-lg-12 col-xs-12" style="padding-left:0px; padding-right:0px;">--}}
        {{--<img src="1.jpg" class="col-lg-12 col-xs-12" style="padding-left:0px; padding-right:0px;">--}}
    {{--</div>--}}

    <div class="col-lg-12">

        <p> Hi {{$user->name}},</p>
        <p>
            Thanks for ordering with GB Mart. We are preparing your product for delivery now. </p>

    </div>

    <div class="col-lg-offset-4 col-lg-4" style="background-color:gray; border-radius:50px; ">


        <center><a href="{{url("track/$payment_reference")}}" target="blank" style="text-decoration:none;"><h3
                        style="color:red"> Track Your Order </h3></a>
        </center>

    </div>

    <div class="col-lg-12">

        <p>Customer Information <br> {{$user->name}},</p>
        <p>
            {{$orders->first()->address}}</p>

    </div>


    <div class="container col-lg-12">
        <h2>Order Summary</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>S.no</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delivery Charges</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0;
                    $paymentMethod='';
            ?>
            @foreach($orders as $index => $order)
                <tr>
                    <td>{{$index}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->count}}</td>
                    <td>RS. {{$order->price}}</td>
                    <td>RS. {{$order->delivery_charge}}</td>
                    <td>RS. {{$order->total_amount}}</td>
                    <?php $total = $total + $order->total_amount;
                    $paymentMethod=$order->payment_method;?>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="col-lg-12">

        <p style="font-weight: bold">Total Amount: {{$total}}</p>
        <p>Payment Type: {{$paymentMethod}}</p>
        <p>
            If you have questions on your order, please do contact us. </p>

    </div>


    <div class="col-lg-12">
        <h4> Disclaimer </h4>
        <p>
            The statement mailed to you by GB Mart is not an invoice for any tax or
            commercial purposes. </p>
        <p>
            The final invoice for the order placed will be issued to you by
            Seller.
        </p>
        <p>
            All applicable taxes and levies as appearing on the website/mobile
            application/ email are being charged and determined by GBMart
            and as informed to GB Mart at the time of listing or afterwards.
        </p>
        <p>
            The prices, applicable rates of taxes and the manner of levy of such taxes are
            solely determined by Seller and GB Mart has no involvement
            in the same.
        </p>
        <p>
            The prices and their components may be subject to change at the
            discretion of the Seller.
        </p>
        <p>
            For complete details please refer to our <a href="https://gbmart.in/terms-and-conditions" target="blank"
                                                        style="text-decoration:none">Terms and conditions</a>
        </p>

    </div>

</div>

<div class="col-lg-12" style="height:100px; background-color:gray; padding-left:0px; padding-right:0px;">
    <center>
        <h4> Follow us on: </h4>


        <a href="https://facebook.com" target="blank"> <i style="font-size:24px" class="fa">&#xf09a;</i> </a>
        <a href="https://twitter.com" target="blank"><i style="font-size:24px" class="fa">&#xf099;</i></a>
        <a href="https://instagram.com" target="blank"><i style="font-size:24px" class="fa">&#xf16d;</i></a>
    </center>

</div>


</body>


</html>