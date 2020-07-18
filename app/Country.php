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

 
   
}
