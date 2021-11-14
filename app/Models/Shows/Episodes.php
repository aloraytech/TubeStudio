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


    public function videos()
    {
        return $this->hasOne(Videos::class,'videos_id')->withDefault();
    }

    public function seasons()
    {
        return $this->belongsTo(Seasons::class);
    }


}
