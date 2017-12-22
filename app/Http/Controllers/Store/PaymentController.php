<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderLog;
use App\Traits\SMSTrait;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Session;

class PaymentController extends Controller
{

    // protected $ebs_secret_key = "0b6f61afae9669a3e8de59aeaae61b9e";
    protected $zaakpay_merchent_identifier = "ebc4c5362f04417f924b54c8e53af5b2";

    protected $zaakpay_secret_key = "52a7969871834d6dbc0ae30dc3f1feb1";

    // protected $parameters = [
    // 	"channel" => "0",
    // 	"account_id" => "23469",
    // 	"reference_no" => "",
    // 	"amount" => "",
    // 	"currency" => "INR",
    // 	"display_currency" => "",
    // 	"display_currency_rates" => "",
    // 	"description" => "",
    // 	"return_url" => "",
    // 	"mode" => "LIVE",
    // 	"payment_mode" => "",
    // 	"card_brand" => "",
    // 	"payment_option" => "",
    // 	"bank_code" => "",
    // 	"emi" => "",
    // 	"page_id" => "",
    // 	"name" => "",
    // 	"address" => "",
    // 	"city" => "",
    // 	"state" => "",
    // 	"postal_code" => "",
    // 	"country" => "IND",
    // 	"email" => "",
    // 	"phone" => "",
    // 	"ship_name" => "",
    // 	"ship_address" => "",
    // 	"ship_city" => "",
    // 	"ship_state" => "",
    // 	"ship_postal_code" => "",
    // 	"ship_country" => "",
    // 	"ship_phone" => "",
    // 	"secure_hash" => ""
    // ];

    protected $parameters = [
        "amount" => '',
        "bankid" => '',
        "buyerAddress" => '',
        "buyerCity" => '',
        "buyerCountry" => 'IND',
        "buyerEmail" => '',
        "buyerFirstName" => '',
        "buyerLastName" => '',
        "buyerPhoneNumber" => '',
        "buyerPincode" => '',
        "buyerState" => '',
        "currency" => 'INR',
        "debitorcredit" => '',
        "merchantIdentifier" => '',
        "merchantIpAddress" => '166.62.30.150',
        "mode" => '1',
        "orderId" => '',
        "product1Description" => '',
        "product2Description" => '',
        "product3Description" => '',
        "product4Description" => '',
        "productDescription" => '',
        "productInfo" => '',
        "purpose" => '1',
        "returnUrl" => '',
        "shipToAddress" => '',
        "shipToCity" => '',
        "shipToCountry" => '',
        "shipToFirstname" => '',
        "shipToLastname" => '',
        "shipToPhoneNumber" => '',
        "shipToPincode" => '',
        "shipToState" => '',
        "showMobile" => '',
        "txnDate" => '',
        "txnType" => '1',
        "zpPayOption" => '1',
        "checksum" => ''
    ];

    public function request($payment_reference, Request $request)
    {
        // dd($request);
        $orders = Order::where("payment_reference", $payment_reference)->get();
        $parameters = $this->parameters;
        $status = "";
        $payment_method = "";
        if (count($orders) > 0) {
            // $parameters['_token'] = csrf_token();
            $parameters['merchantIdentifier'] = $this->zaakpay_merchent_identifier;
            // $parameters['reference_no'] = $payment_reference;
            $parameters['orderId'] = $payment_reference;
            $parameters['amount'] = 0;
            $parameters['productDescription'] = "Payment of order for " . Auth::user()->email . " , " . $payment_reference . ", on " . date('d-M-y');
            $parameters['returnUrl'] = $request->root() . '/store/pay/response/' . $payment_reference;
            $parameters['buyerFirstName'] = Auth::user()->name;
            $parameters['buyerEmail'] = Auth::user()->email;
            $parameters['buyerPhoneNumber'] = Auth::user()->mobile_number;
            $parameters['txnDate'] = date('Y-m-d');
            // $parameters['merchantIpAddress'] = "127.0.0.1";

            foreach ($orders as $index => $order) {
                if ($index == 0) {
                    $parameters['buyerAddress'] = $order->address;
                    $parameters['buyerCity'] = $order->city;
                    $parameters['buyerCity'] = $order->state;
                    $parameters['buyerPincode'] = $order->postal_code;
                    $status = $order->status;
                    $payment_method = $order->payment_method;
                }
                $parameters['amount'] += $order->total_amount;
            }

            // For Zaakpay, it takes paise, instead of rupees
            $parameters['amount'] = $parameters['amount'] * 100;

            // For testing
            // $parameters['amount'] = 100;

            // $hashData = $this->ebs_secret_key;
            // ksort($parameters);
            // foreach ($parameters as $key => $value){
            // 	if (strlen($value) > 0) {
            // 		$hashData .= '|'.$value;
            // 	}
            // }
            // if (strlen($hashData) > 0) {
            // 	$parameters['secure_hash'] = strtoupper(hash("sha512", $hashData));//for SHA512
            // }

            $all = '';
            $checksumsequence = array("amount", "bankid", "buyerAddress", "buyerCity", "buyerCountry", "buyerEmail", "buyerFirstName", "buyerLastName", "buyerPhoneNumber", "buyerPincode", "buyerState", "currency", "debitorcredit", "merchantIdentifier", "merchantIpAddress", "mode", "orderId", "product1Description", "product2Description", "product3Description", "product4Description", "productDescription", "productInfo", "purpose", "returnUrl", "shipToAddress", "shipToCity", "shipToCountry", "shipToFirstname", "shipToLastname", "shipToPhoneNumber", "shipToPincode", "shipToState", "showMobile", "txnDate", "txnType", "zpPayOption");
            foreach ($parameters as $key => $value) {
                if ($key != 'checksum' && $value != "") {
                    $all .= $key;
                    $all .= "=";
                    if ($key == 'returnUrl') {
                        // $all .= Checksum::sanitizedURL($value);
                        $pattern[0] = "%,%";
                        $pattern[1] = "%\(%";
                        $pattern[2] = "%\)%";
                        $pattern[3] = "%\{%";
                        $pattern[4] = "%\}%";
                        $pattern[5] = "%<%";
                        $pattern[6] = "%>%";
                        $pattern[7] = "%`%";
                        $pattern[8] = "%!%";
                        $pattern[9] = "%\\$%";
                        $pattern[10] = "%\%%";
                        $pattern[11] = "%\^%";
                        $pattern[12] = "%\+%";
                        $pattern[13] = "%\|%";
                        $pattern[14] = "%\\\%";
                        $pattern[15] = "%'%";
                        $pattern[16] = "%\"%";
                        $pattern[17] = "%;%";
                        $pattern[18] = "%~%";
                        $pattern[19] = "%\[%";
                        $pattern[20] = "%\]%";
                        $pattern[21] = "%\*%";
                        $all .= preg_replace($pattern, "", $value);
                    } else {
                        // $all .= Checksum::sanitizedParam($value);$pattern[0] = "%,%";
                        $pattern[1] = "%#%";
                        $pattern[2] = "%\(%";
                        $pattern[3] = "%\)%";
                        $pattern[4] = "%\{%";
                        $pattern[5] = "%\}%";
                        $pattern[6] = "%<%";
                        $pattern[7] = "%>%";
                        $pattern[8] = "%`%";
                        $pattern[9] = "%!%";
                        $pattern[10] = "%\\$%";
                        $pattern[11] = "%\%%";
                        $pattern[12] = "%\^%";
                        $pattern[13] = "%=%";
                        $pattern[14] = "%\+%";
                        $pattern[15] = "%\|%";
                        $pattern[16] = "%\\\%";
                        $pattern[17] = "%:%";
                        $pattern[18] = "%'%";
                        $pattern[19] = "%\"%";
                        $pattern[20] = "%;%";
                        $pattern[21] = "%~%";
                        $pattern[22] = "%\[%";
                        $pattern[23] = "%\]%";
                        $pattern[24] = "%\*%";
                        $pattern[25] = "%&%";
                        $all .= preg_replace($pattern, "", $value);
                    }
                    $all .= "&";
                }
            }

            $hash = hash_hmac('sha256', $all, $this->zaakpay_secret_key);
            $checksum = $hash;

            $parameters['checksum'] = $checksum;
            // dd($all);

            if ($status == "PENDING" && $payment_method == "COD") {
                Cart::destroy();
                if (count($orders) == 1) {
                    SMSTrait::send(Auth::user()->mobile_number, "Your order for " . (strlen($orders[0]->product->display_name) > 20 ? substr($orders[0]->product->display_name, 0, 15) . '...' : $orders[0]->product->display_name) . "  has been placed. Order Ref.: " . $payment_reference);
                } else if (count($orders) > 1) {
                    SMSTrait::send(Auth::user()->mobile_number, "Your order for " . count($orders) . " items(s) has been placed. Order Ref.: " . $payment_reference);
                }
                return redirect('/')->with('message', 'Your order is successful.');
            } else if ($status == "INITIATED" && $payment_method == "ONLINE") {
                // dd($parameters);
                return view('store.pay-request', ['parameters' => $parameters]);
            } else {
                return abort(400);
            }
        } else {
            return abort(404);
        }
    }

    public function response($payment_reference, Request $request)
    {
        if ($request->has('responseCode')) {
            if ($request->get('responseCode') == '100') {
                Cart::destroy();
                $orders = Order::where('payment_reference', $payment_reference)->get();
                foreach ($orders as $order) {
                    $order->status = "PENDING";
                    $order->save();

                    OrderLog::create([
                        'order_id' => $order->id,
                        'status' => $order->status,
                        'remarks' => 'Payment completed.'
                    ]);
                }
                if (count($orders) == 1) {
                    SMSTrait::send(Auth::user()->mobile_number, "Your order for " . (strlen($orders[0]->product->display_name) > 20 ? substr($orders[0]->product->display_name, 0, 15) . '...' : $orders[0]->product->display_name) . "  has been placed. Order Ref.: " . $payment_reference);
                } else if (count($orders) > 1) {
                    SMSTrait::send(Auth::user()->mobile_number, "Your order for " . count($orders) . " items(s) has been placed. Order Ref.: " . $payment_reference);
                }
                $user = \Auth::user();
                \Mail::send('mails.order-placed', compact('user', 'orders', 'payment_reference'), function ($message) use ($user) {
                    $message->to($user->email, $user->name)->bcc(['sales@gbmart.in'])
                        ->subject('Order Placed!');
                });
            } else {
                $orders = Order::where('payment_reference', $payment_reference)->get();
                foreach ($orders as $order) {
                    $order->status = "FAILED";
                    $order->save();

                    OrderLog::create([
                        'order_id' => $order->id,
                        'status' => $order->status,
                        'remarks' => 'Payment failed.'
                    ]);
                }
            }
        }
        return view('store.pay-response');
    }
}
