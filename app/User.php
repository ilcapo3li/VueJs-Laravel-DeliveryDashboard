<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    
    

    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }


    ///////////////////test propose//////////////////////
    // public function favouriteLeagues()
    // {
    //     return $this->belongsToMany(League::class, 'favorites', 'user_id', 'type_id')->where('type', 'league')->with('photo');
    // }

    ///////////////////////////////////////////////////

    public function attchment()
    {
        return $this->belongsTo(Attachment::class, 'attchment_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    public function registerTokens()
    {
        return $this->hasMany(ApiKey::class,'owner');
    }

    public function authTokens()
    {
        return $this->hasMany(OwnerToken::class,'owner');
    }

    public function locations()
    {
        return $this->morphMany(Location::class, 'owner');
    }
}
