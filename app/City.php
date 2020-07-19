<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    $prtected guarded = [];

    public function country()
    {
    	return $this->hasOne(Country::class,'country_id');
    }

     public function zones()
    {
    	return $this->hasMany(Zone::class,'city_id');
    }
}
