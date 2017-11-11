<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SMSTrait;

class OrderLog extends Model
{
    protected $fillable =[
    	'order_id',
    	'status',
    	'remarks'
    ];

    protected static function boot() {
        parent::boot();

        static::created(function($order_log) {
        	if ($order_log->status == 'PENDING') {
	        	SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been placed. Waiting for confimation.');
	        }
            if ($order_log->status == 'REJECTED') {
                SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been rejected.');   
            }
            if ($order_log->status == 'APPROVED') {
                SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been confirmed.');   
            }
            if ($order_log->status == 'PACKED') {
                SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been packed and soon will be shipped.');   
            }
            if ($order_log->status == 'SHIPPED') {
                SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been shipped and soon will reach you.');   
            }
            if ($order_log->status == 'DELIVERED') {
                SMSTrait::send($order_log->order->customer->mobile_number, 'Order (#' . $order_log->order_id . ') for ' . $order_log->order->seller_product->product->display_name ' has been delivered. Thank you for shopping with us.');   
            }
        });
    }

    public function order() {
    	return $this->belongsTo('App\Order', 'order_id');
    }
}
