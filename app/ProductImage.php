<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable =[
    	'product_id',
    	'url',
    	'status'
    ];

    public function product() {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
