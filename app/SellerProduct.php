<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    protected $fillable = [
        'product_id',
        'seller_id',
        'seller_price',
        'delivery_charge',
        'is_in_stock',
        'is_cod_available',
        'is_online_payment_available',
        'status'
    ];

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'seller_product_id');
    }

    public function attribute_values()
    {
        return $this->hasMany(AttributeValue::class, 'seller_product_id');
    }
}
