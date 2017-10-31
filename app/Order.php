<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\OrderLog;

class Order extends Model
{
    protected $fillable =[
    	'customer_id',
    	'product_id',
    	'seller_product_id',
        'address',
        'city',
        'state',
        'postal_code',
        'extra',
    	'count',
    	'price',
    	'delivery_charge',
    	'total_amount',
        'payment_method',
        'payment_reference',
    	'status'
    ];

    protected static function boot() {
        parent::boot();

        static::created(function($order) {
            if ($order->status == "INITIATED") {
                OrderLog::create([
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'remarks' => 'Order created for product "' . $order->product->display_name .'" at Rs. ' . number_format($order->seller_product->seller_price, 2, '.', ',') . ', waiting for completion of payment. REF: ' . $order->payment_reference
                ]);
            }
            if ($order->status == "PENDING") {
                OrderLog::create([
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'remarks' => 'Order created for product "' . $order->product->display_name .'" at Rs. ' . number_format($order->seller_product->seller_price, 2, '.', ',') . ', waiting for acceptance from seller. REF: ' . $order->payment_reference
                ]);
            }
        });
    }   

    public function customer() {
    	return $this->belongsTo('App\User', 'customer_id');
    }

    public function product() {
    	return $this->belongsTo('App\Product', 'product_id');
    }

    public function seller_product() {
    	return $this->belongsTo('App\SellerProduct', 'seller_product_id');
    }

    public function order_logs() {
    	return $this->hasMany('App\OrderLog', 'order_id');
    }
}
