<?php

namespace App\Models\Shows;

use App\Models\Movies\Videos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner',
        'desc',
        'duration',
        'release_on',
    ];
    protected $casts = [
        'seasons' => 'array',
    ];

    public function videos()
    {
        return $this->hasOne(Videos::class,'video_id')->withDefault();
    }

    public function seasons()
    {
        return $this->belongsToMany(Seasons::class,'season_episode');
    }


}
