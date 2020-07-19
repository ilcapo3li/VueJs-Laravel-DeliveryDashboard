<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    $prtected guarded = [];

    public function orders()
    {
    	return $this->hasMany(Order::class,'status_id');
    }
 
}
