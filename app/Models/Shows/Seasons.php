<?php

namespace App\Models\Shows;

use App\Models\System\Activities;
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
        return $this->hasMany(Episodes::class)->latest('created_at');
    }

    public function trailers()
    {
        return $this->hasMany(Trailers::class)->latest('created_at');
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }

}
