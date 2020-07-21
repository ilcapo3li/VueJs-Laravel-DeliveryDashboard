<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    public function creator()
    {
    	return $this->hasOne(User::class,'creator_id');
    }

    public function tayar()
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

    public function price()
    {
    	return $this->belongsTo(Price::class,'price_id');
    }

    public function creatorLocation()
    {
        return $this->belongsTo(Location::class,'home_id');
    } 

    public function leadLocation()
    {
        return $this->belongsTo(Location::class,'away_id');
    }  

    
}
