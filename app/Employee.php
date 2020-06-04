<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = ['user_id','nid','nid_details','details'];
 

    public function User()
    {
         return $this->belongsTo('App\User');
    }
    public function Order()
    {
         return $this->hasMany('App\Order');
    }
     

}
