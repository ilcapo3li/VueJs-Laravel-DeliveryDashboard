<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function OrderSender()
    {
    	return $this->morphTo();
    }

    public function tayar()
    {
    	return $this->hasOne(User::class,'collected_by');
    }

    public function company()
    {
    	return $this->hasOne(Company::class,'company_id');
    }

    public function OrderReceiver()
    {
    	return $this->morphTo();
    }

    public function status()
    {
    	return $this->belongsTo(Status::class,'status_id');
    } 

  
    public function price()
    {
    	return $this->belongsTo(Price::class,'price_id');
    }

    public function senderLocation()
    {
        return $this->belongsTo(Location::class,'home_id');
    } 

    public function receiverLocation()
    {
        return $this->belongsTo(Location::class,'away_id');
    }  


    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class,'order_id');
    }

    public function orderParent()
    {
        return $this->hasOne(OrderLog::class,'parent_id');
    }

    public function orderMaterial()
    {
        return $this->hasOne(OrderItem::class,'material_id');
    }  


    
}
