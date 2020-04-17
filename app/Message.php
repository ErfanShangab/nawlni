<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function Merchant()
    {
         return $this->belongsTo('App\Merchant');
    } 
    
    public function Customer()
    {
         return $this->belongsTo('App\Customer');
    }
}
