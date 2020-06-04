<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['name', 'details' ,'image' ,'category_id' ];

    public function  Category()
    {

        
         return $this->belongsTo('App\Category');
    }

    public function Product()
    {

        
         return $this->hasMany('App\Product');
    }
}
