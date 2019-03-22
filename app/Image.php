<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
