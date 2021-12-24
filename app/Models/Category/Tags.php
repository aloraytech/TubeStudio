<?php

namespace App\Models\Category;

use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];



    public function movies()
    {
        return $this->belongsTo(Movies::class,'tags_id','id')->withDefault();
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class,'tags_id','id')->withDefault();
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class,'tags_id','id')->withDefault();
    }



}
