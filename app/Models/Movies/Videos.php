<?php

namespace App\Models\Movies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Videos extends Model
{
    use HasFactory,AsSource,Attachable;

    protected $fillable = [
        'title',
        'author',
        'channel',
        'height',
        'width',
        'provider',
        'thumb_h',
        'thumb_w',
        'code',
        'thumb_url'

    ];

    protected $hidden = ['created_at','updated_at'];


    protected static function booted()
    {
        static::deleted(function ($video) {
            $video->attachment->each->delete();
        });
    }


    public function movie()
    {
        return $this->belongsTo(Movies::class,'videos_id','id')->withDefault();
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(Attachment::class, 'id', 'thumb_url')->withDefault();
    }

    public function trailer_files()
    {
        return $this->hasOne(Attachment::class, 'id', 'path_url')->withDefault();
    }



}
