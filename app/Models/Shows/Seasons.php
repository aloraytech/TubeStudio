<?php

namespace App\Models\Shows;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;

    protected $casts = [
        'episodes' => 'array',
    ];

    protected $fillable = [
        'name',
        'desc',
    ];

    public function episodes()
    {
        return $this->belongsToMany(Episodes::class,'season_episode');
    }

    public function shows()
    {
        return $this->belongsToMany(Shows::class,'show_season');
    }



}
