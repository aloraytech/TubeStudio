<?php

namespace App\Models\Shows;

use App\Models\Movies\Videos;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $display_image
 * @property $release_on
 * @property $videos
 * @property $e_code
 */
class Episodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_image',
        'desc',
        'duration',
        'release_on',
        'status',
        'e_code'
    ];


    public function videos()
    {
        return $this->hasOne(Videos::class,'id','videos_id')->withDefault();
    }

    public function seasons()
    {
        return $this->belongsTo(Seasons::class,'id','seasons_id')->withDefault();
    }
    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }

}
