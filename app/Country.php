<?php

namespace App;

use App\League;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function photo()
    {
        return $this->hasOne('App\Photo');
    }

    public function toranment()
    {
        return $this->hasOne('App\Toranment');
    }
    public function leagues()
    {
        return $this->hasMany(League::class, 'country_id');
    }
}
