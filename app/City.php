<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    public function country()
    {
    	return $this->belongsTo(Country::class,'country_id');
    }

    public function governorate()
    {
    	return $this->belongsTo(Governorate::class,'governorate_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

     public function zones()
    {
    	return $this->hasMany(Zone::class,'city_id');
    }
}
