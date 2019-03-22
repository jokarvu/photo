<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'description', 'parent_id'];
    
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
        return $this->belongsTo(Location::class, 'parent_id')->withDefault(['name' => 'None']);
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
        $this->attributes['name'] = ucfirst($value);
    }
}
