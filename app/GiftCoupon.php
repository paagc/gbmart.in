<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCoupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','value', 'type', 'max_amount', 'end_date', 'status'
    ];
}
