<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
    	'name',
    	'display_name',
    	'fa_icon',
    	'status'
    ];

    public function sub_categories() {
    	return $this->hasMany('App\SubCategory', 'category_id');
    }

    public function products() {
    	return $this->hasMany('App\Product', 'category_id');
    }
}
