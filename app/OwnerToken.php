<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerToken extends Model
{
   protected $table='owner_tokens';

   public function owner()
    {
    	   return $this->morphTo();
    }
}
