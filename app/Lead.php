<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{


    public function orders()
    {
    	return $this->hasMany(Order::class,'lead_id');
    }

    public function locations()
    {
    	return $this->hasMany(Location::class,'type_id')->where('type','lead');
    } 
}
