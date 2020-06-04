<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['name','details' ,'subcategory_id','client_id','image','is_adverise'];

    public function SubCategory()
    {
         return $this->belongsTo('App\SubCategory','subcategory_id');
    }
    public function Client()
    {
         return $this->belongsTo('App\Client');
    }
  
}
