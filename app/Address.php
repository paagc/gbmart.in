<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'line_1',
        'line_2',
        'city_town',
        'state',
        'pin_code',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
