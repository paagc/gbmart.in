<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable =[
    	'category_id',
    	'name',
    	'display_name',
    	'status'
    ];

    public function category() {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function products() {
    	return $this->hasMany('App\Product', 'sub_category_id');
    }
}
