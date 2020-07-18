<?php

namespace App;

use App\Like;
use SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $appends = [
        'likes' 
    ];
     public function getLikesAttribute()
    {
        return $this->likedComment()->count();
    }
    protected $fillable=['user_id','comment','commentable_id','commentable_type'];
   
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }
    public function likedComment()
    {
        return $this->hasMany(Like::class, 'type_id')->where('type', 'comment');
    }
}
