<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
    	'customer_id',
    	'product_id',
    	'seller_product_id',
    	'count',
    	'price',
    	'delivery_charge',
    	'total_amount',
        'payment_method',
    	'status'
    ];

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
