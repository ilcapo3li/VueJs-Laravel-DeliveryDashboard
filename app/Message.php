<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Message extends Model
{
    protected $fillable=['message','user_id','receiver_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
