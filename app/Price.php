<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    


    public function zone()
    {
    	return $this->hasOne(Zone::class,'zone_id');
    }

}
