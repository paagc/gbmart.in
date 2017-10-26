<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    protected $fillable =[
    	'title',
    	'image_url',
    	'link_url',
    	'status'
    ];
}
