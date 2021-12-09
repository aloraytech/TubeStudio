<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    public function systems()
    {
        return $this->belongsTo(Systems::class,'themes_id','id');
    }


}
