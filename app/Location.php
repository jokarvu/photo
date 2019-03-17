<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function father()
    {
        return $this->belongsTo(Location::class)->withDefault(['name: None']);
    }
}
