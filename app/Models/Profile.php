<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the profile's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
