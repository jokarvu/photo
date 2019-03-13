<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
}
