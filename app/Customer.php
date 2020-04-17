<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $fillable = ['user_id'];
    public function User()
    {
         return $this->belongsTo('App\User');
    }
    public function Order()
    {
         return $this->hasMany('App\Order');
    }
    public function Message()
    {
         return $this->hasMany('App\Message');
    }

}
