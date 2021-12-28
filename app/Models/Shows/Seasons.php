<?php

namespace App\Models\Shows;

use App\Models\Category\Tags;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $shows_id
 * @property $name
 */
class Seasons extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'desc',
        'status',
        'display_image'
    ];

    public function episodes()
    {
        return $this->hasMany(Episodes::class,'seasons_id','id');
    }



    public function trailers()
    {
        return $this->hasMany(Trailers::class,'seasons_id','id');
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

}
