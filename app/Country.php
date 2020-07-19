<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    $prtected guarded = [];

    public function zones()
    {
        return $this->hasMany(Zone::class,'country_id');
    }

     public function cities()
    {
    	return $this->hasMany(City::class,'country_id');
    }

 
   
}
