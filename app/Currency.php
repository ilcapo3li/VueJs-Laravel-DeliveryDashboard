<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{


    public function country()
    {
    	return $this->belongsTo(Country::class,'country_id');
    }

     public function zones()
    {
    	return $this->hasMany(Zone::class,'city_id');
    }
}
