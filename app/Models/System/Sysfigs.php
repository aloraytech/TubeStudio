<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sysfigs extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];
}
