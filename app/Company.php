<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function admins()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',2);
    }

    public function suppliers()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',3);
    }

    public function agents()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',4);
    }

    public function tayar()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',5);
    }

    public function leads()
    {
        return $this->hasMany(User::class, 'company_id')->where('role_id',6);
    }
}
