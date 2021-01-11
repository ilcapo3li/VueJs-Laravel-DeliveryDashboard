<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    public function country()
    {
    	return $this->belongsTo(Country::class,'country_id');
    }

    public function zones()
    {
        return $this->hasMany(Zone::class,'country_id');
    }
}
