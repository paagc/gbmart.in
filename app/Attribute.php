<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'status'
    ];

    protected function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected function attribute_values()
    {
        return $this->hasMany('App\AttributeValue', 'attribute_id');
    }
}
