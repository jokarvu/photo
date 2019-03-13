<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function hires()
    {
        return $this->belongsToMany(Hire::class);
    }
}
