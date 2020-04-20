<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name', 'details' ,'image' ];

    public function Product()
    {

        
         return $this->hasMany('App\Product');
    }
}
