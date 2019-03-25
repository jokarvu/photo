<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['content', 'photographer_id', 'user_id', 'rate'];
    
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
}
