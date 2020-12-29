<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Role extends Model
{
    use HasFactory;

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
