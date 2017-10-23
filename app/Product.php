<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id',
    	'sub_category_id',
    	'name',
    	'display_name',
    	'brand',
    	'original_price',
    	'description_text',
        'description_image_url',
        'description_video_url',
    	'is_featured',
    	'status'
    ];

    public function category() {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function sub_category() {
    	return $this->belongsTo('App\SubCategory', 'sub_category_id');
    }

    public function attributes() {
    	return $this->hasMany('App\Attribute', 'product_id');
    }

    public function seller_products() {
    	return $this->hasMany('App\SellerProduct', 'product_id');
    }

    public function orders() {
    	return $this->hasMany('App\Order', 'product_id');
    }
}
