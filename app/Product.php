<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['name','details' ,'category_id','client_id','image','is_adverise'];

    public function Category()
    {
         return $this->belongsTo('App\Category');
    }
    public function Client()
    {
         return $this->belongsTo('App\Client');
    }
  
}
