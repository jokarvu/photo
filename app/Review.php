<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
}
