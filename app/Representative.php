<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Representative extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'representative_id');
    }

    public function sentOrders()
    {
        return $this->morphMany(Order::class, 'sender');
    }

    public function receivedOrders()
    {
        return $this->morphMany(Order::class, 'receiver');
    }

    public function registerTokens()
    {
        return $this->morphMany(ApiKey::class,'owner');
    }

    public function authTokens()
    {
        return $this->morphMany(OwnerToken::class,'owner');
    }

   
    public function locations()
    {
        return $this->morphMany(Location::class, 'owner');
    }
}
  


