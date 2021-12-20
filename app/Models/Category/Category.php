<?php

namespace App\Models\Category;

use App\Models\Movies\Movies;
use App\Models\Posts;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Category extends Model
{
    use HasFactory,
        AsSource,Attachable;

    protected $fillable = [
        'name',
        'type',
        'banner'
    ];


    public function movie()
    {
        return $this->belongsToMany(Movies::class,'movies');
    }


    public function shows()
    {
        return $this->belongsToMany(Shows::class,'shows','categories_id')->where('type','=','show');
    }

    public function posts()
    {
        return $this->belongsToMany(Posts::class);
    }

    public function banners()
    {
        //return $this->belongsToMany(Attachment::class,'attachments','id','banner','banner');
        return $this->hasOne(Attachment::class, 'id', 'banner')->withDefault();
    }

}
