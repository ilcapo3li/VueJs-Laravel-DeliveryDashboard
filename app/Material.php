<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function zones()
    {
        return $this->belongsTo(MatrialType::class,'country_id');
    }
}
