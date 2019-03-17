<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function toMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function fromMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        // This returns his reviews about other photographer
        return $this->hasMany(Review::class, 'user_id');
    }

    public function hisReviews()
    {
        // This return people's reviews about him        
        return $this->hasMany(Review::class, 'photographer_id');
    }

    public function hires()
    {
        // Hire
        return $this->hasMany(Hire::class);
    }

    public function hisHires()
    {
        // Be hired
        return $this->hasMany(Hire::class, 'photographer_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // Permission check
    public function hasPermission(Permission $permission)
    {
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }

    // Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
