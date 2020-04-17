<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

     protected $fillable = ['vehicle_id'];

    public function User()
    {
         return $this->belongsTo('App\User');
    }

    public function Order()
    {
         return $this->hasMany('App\Order');
    }

}
