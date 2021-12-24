<?php

namespace App\Models\System;

use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;



    public function seasons()
    {
        return $this->belongsTo(Seasons::class);
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }

    public function episodes()
    {
        return $this->belongsTo(Episodes::class);
    }

    public function members()
    {
        return $this->belongsTo(Members::class);
    }


    public function movies()
    {
        return $this->belongsTo(Movies::class);
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }








}
