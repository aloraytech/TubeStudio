<?php

namespace App\Models\System;

use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    public function seasons()
    {
        return $this->hasMany(Seasons::class);
    }

    public function shows()
    {
        return $this->hasMany(Shows::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }

    public function members()
    {
        return $this->hasMany(Members::class);
    }


    public function movies()
    {
        return $this->hasMany(Movies::class);
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }


}
