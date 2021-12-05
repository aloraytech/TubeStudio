<?php

namespace App\Models\Shows;

use App\Models\Movies\Videos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailers extends Model
{
    use HasFactory;


    public function videos()
    {
        return $this->hasOne(Videos::class,'id','videos_id')->withDefault();
    }

    public function seasons()
    {
        return $this->belongsTo(Seasons::class,'id','seasons_id')->withDefault();
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class,'trailer','id')->withDefault();
    }


}
