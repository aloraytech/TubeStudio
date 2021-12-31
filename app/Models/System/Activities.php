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

    protected $fillable = [
        'in_time',
        'out_time',
        'subject',
        'url_visit',
        'url_from',
        'guest',
        'guest_contact',
        'detail'
    ];



    public function members()
    {
        return $this->belongsTo(Members::class);
    }

}
