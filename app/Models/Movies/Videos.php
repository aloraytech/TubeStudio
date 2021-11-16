<?php

namespace App\Models\Movies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'channel',
        'height',
        'width',
        'provider',
        'thumb_url',
        'thumb_h',
        'thumb_w',
        'code',
    ];

    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }


}
