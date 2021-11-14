<?php

namespace App\Models\Shows;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'desc',
    ];

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }



}
