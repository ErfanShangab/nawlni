<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function Customer()
    {
         return $this->belongsTo('App\Customer');
    }
    public function Driver()
    {
         return $this->belongsTo('App\Driver');
    } 
    
    public function Client()
    {
         return $this->belongsTo('App\Client');
    }
}
