<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['name', 'price', 'description'];
    
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
