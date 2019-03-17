<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Users of this permission
    public function scopeUsers($query)
    {
        return $query->select('users.*')->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
                        ->join('roles', 'permission_role.role_id', '=', 'roles.id')
                        ->join('users', 'users.role_id', '=', 'permission_role.role_id')
                        ->where('permissions.id', $this->id);
    }


    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value);
    }
}
