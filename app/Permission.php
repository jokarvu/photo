<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value);
    }
}
