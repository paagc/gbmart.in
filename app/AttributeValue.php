<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'seller_product_id',
        'attribute_id',
        'value',
        'status'
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute', 'attribute_id');
    }

    public function seller_product()
    {
        return $this->belongsTo('App\SellerProduct', 'seller_product_id');
    }
}
