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

    public function favouriteLeagues()
    {
        return $this->belongsToMany(League::class, 'favorites', 'user_id', 'type_id')->where('type', 'league')->with('photo');
    }

    public function favouriteMatches()
    {
        return $this->belongsToMany(Match::class, 'favorites', 'user_id', 'type_id')->where('type', 'match')->with('HomeTeamBadge')->with('AwayTeamBadge');
    }

    public function favouriteTournamentMatch()
    {
        return $this->belongsToMany(ToranmentMatch::class, 'favorites', 'user_id', 'type_id')->where('type', 'tournament_match')->with(['toranmentType', 'homeTeam.photo', 'awayTeam.photo']);
    }

    public function favouriteVideos()
    {
        return $this->belongsToMany(Video::class, 'favorites', 'user_id', 'type_id')->where('type', 'video')->with('photo');
    }

    public function favouriteNews()
    {
        return $this->belongsToMany(NewsPost::class, 'favorites', 'user_id', 'type_id')->where('type', 'news')->with('postPhoto');
    }

    public function favouriteStandings()
    {
        return $this->belongsToMany(Standing::class, 'favorites', 'user_id', 'type_id')->where('type', 'standing')->with('photo');
    }

    public function favouriteChannels()
    {
        return $this->belongsToMany(Channel::class, 'favorites', 'user_id', 'type_id')->where('favorites.type', 'channel')->with('photo');
    }

    public function favouriteCategories()
    {
        return $this->belongsToMany(Category::class, 'favorites', 'user_id', 'type_id')->where('type', 'category')->with('photo');
    }

    ///////////////////test propose//////////////////////
    // public function categories()
    // {
    //     return $this->hasMany(Favorite::class)->where('type','category');
    // }
    //  public function matches()
    // {
    //     return $this->hasMany(Favorite::class)->where('type','match');
    // }
    //  public function league()
    // {
    //     return $this->hasMany(Favorite::class)->where('type','league');
    // }
    ///////////////////////////////////////////////////

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
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

    public function likedVideo()
    {
        return $this->hasmany(Like::class)->where('likes.type', 'video');
    }

    public function likedChannel()
    {
        return $this->hasmany(Like::class)->where('likes.type', 'channel');
    }

    public function likedNews()
    {
        return $this->hasmany(Like::class)->where('likes.type', 'news');
    }

    public function likedComment()
    {
        return $this->hasmany(Like::class)->where('likes.type', 'comment');
    }

    public function newsComments()
    {
        return $this->hasMany(Comment::class)->where('commentable_type', 'news');
    }

    public function videosComments()
    {
        return $this->hasMany(Comment::class)->where('commentable_type', 'video');
    }
     public function channelComments()
    {
        return $this->hasMany(Comment::class)->where('commentable_type', 'channel');
    }

    public function replayComments()
    {
        return $this->hasMany(Comment::class)->where('commentable_type', 'replay');
    }
     public function matchComments()
    {
        return $this->hasMany(Comment::class)->where('commentable_type', 'match');
    }
}
