<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

     protected $fillable = ['balance', 'type' ,'details' ,'user_id'];

    public function User()
    {
         return $this->belongsTo('App\User');
    }

    public function Order()
    {
         return $this->hasMany('App\Order');
    }
//     public function Pay()
//     {
//          return $this->hasMany('App\Pay');
//     }
    public function Message()
    {
         return $this->hasMany('pp\Message');
    }

}
