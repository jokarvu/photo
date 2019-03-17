<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'taggable');
    }

    public function locations()
    {
        return $this->morphedByMany(Location::class, 'taggable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
