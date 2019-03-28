<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['name', 'offer', 'discount', 'description', 'code', 'user_id'];
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
