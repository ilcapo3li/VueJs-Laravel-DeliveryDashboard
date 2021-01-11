<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
	public function owner()
    {
    	return $this->morphTo();
    }
}
