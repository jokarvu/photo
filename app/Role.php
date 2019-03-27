<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{   
    protected $fillable = ['name', 'description', 'dashboard']; 
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value);
    }
}
