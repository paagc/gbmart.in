<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'status',
        'start_date',
        'end_date'
    ];
}
