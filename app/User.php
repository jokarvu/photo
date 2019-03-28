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

    public function reviewFrom()
    {
        // This returns his reviews about other photographer
        return $this->hasMany(Review::class, 'user_id');
    }

    public function reviewTo()
    {
        // This return people's reviews about him        
        return $this->hasMany(Review::class, 'photographer_id');
    }

    public function fromInvoices()
    {
        // invoice create by user
        return $this->hasMany(Invoice::class);
    }

    public function toInvoices()
    {
        return $this->hasMany(Invoice::class, 'photographer_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'photographer_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    // Permission check
    public function hasPermission(Permission $permission)
    {
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }
    
    // Option check
    public function hasOption(Option $option)
    {
        return !! optional(optional($this->options)->contains($option));
    }

    // Review owner check
    public function hasReview(Review $review)
    {
        return !! optional(optional($this->reviewFrom)->contains($review));
    }

    // Coupon check
    public function hasCoupon(Coupon $coupon)
    {
        return !! optional(optional($this->coupons)->contains($coupon));
    }

    public function hasInvoice(Invoice $invoice)
    {
        return !! optional($this->fromInvoices)->contains($invoice) || !! optional($this->toInvoices)->contains($invoice);
    }

    // Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
