<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systems extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];


    public function themes()
    {
        return $this->hasOne(Themes::class,'id','themes_id')->withDefault();
    }



}
