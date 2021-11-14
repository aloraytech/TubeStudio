<?php

namespace App\Models\Movies;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quality',
        'banner',
        'desc',
        'tags',
        'release_on',
    ];


    public function videos()
    {
        return $this->hasOne(Videos::class,'video_id')->withDefault();
    }


    public function categories()
    {
        return $this->hasOne(Category::class,'category_id')->withDefault();
    }




}
