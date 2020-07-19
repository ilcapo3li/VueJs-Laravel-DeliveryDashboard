<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     $prtected guarded = [];


    public function creator()
    {
    	return $this->hasOne(User::class,'creator_id');
    }

    public function collector()
    {
    	return $this->hasOne(User::class,'collected_by');
    }

    public function receiver()
    {
    	return $this->hasOne(Lead::class,'lead_id');
    }

    public function status()
    {
    	return $this->belongsTo(Status::class,'status_id');
    } 

    public function materialType()
    {
    	return $this->belongsTo(MaterialType::class,'material_type_id');
    }

    public function materialType()
    {
    	return $this->belongsTo(Price::class,'price_id');
    } 

    
}
