<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function hires()
    {
        return $this->hasMany(Hire::class);
    }
}
