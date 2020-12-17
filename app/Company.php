<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function orders()
    {
        return $this->hasMany(Order::class, 'company_id');
    }

    public function admins()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',2);
    }

    public function agents()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',1);
    }

    public function representatives()
    {
        return $this->hasMany(Representatives::class, 'company_id');
    }

    
}
