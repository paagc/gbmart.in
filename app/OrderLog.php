<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable =[
    	'order_id',
    	'status',
    	'remark'
    ];

    public function order() {
    	return $this->belongsTo('App\Order', 'order_id');
    }
}
