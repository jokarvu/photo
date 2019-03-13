<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
