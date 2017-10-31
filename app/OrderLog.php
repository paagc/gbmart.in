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
        	SMSTrait::send($order_log->order->customer->mobile_number, $order_log->remarks);
        });
    }

    public function order() {
    	return $this->belongsTo('App\Order', 'order_id');
    }
}
