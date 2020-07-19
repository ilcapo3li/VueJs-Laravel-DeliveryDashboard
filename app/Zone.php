<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
	$prtected guarded = [];

    public function country()
    {
    	return $this->belongsTo(Country::class,'country_id');
    }

    public function zones()
    {
    	return $this->hasMany(Zone::class,'city_id');
    }

    public function price()
    {
    	return $this->belongsTo(Price::class,'zone_id');
    } 
}
