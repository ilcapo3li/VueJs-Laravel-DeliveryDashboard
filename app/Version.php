<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
