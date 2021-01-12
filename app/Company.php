<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function companySettings()
    {
        return $this->hasMany(DeliverySetting::class, 'company_id');
    }

    public function companyOrders()
    {
        return $this->hasMany(Order::class, 'company_id');
    }

    public function sentOrders()
    {
        return $this->morphMany(Order::class, 'sender');
    }

    public function receivedOrders()
    {
        return $this->morphMany(Order::class, 'receiver');
    }

    public function admins()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',2);
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class,'agent_companies');
    }

    public function representatives()
    {
        return $this->belongsToMany(Representatives::class,'company_representatives');
    }

    public function locations()
    {
        return $this->morphMany(Location::class, 'owner');
    }

    public function company()
    {
        return $this->hasOne(Subscription::class, 'company_id');
    }

    public function companySubscriptionHistory()
    {
        return $this->hasMany(SubscriptionLog::class, 'company_id');
    }

   
    
}
