<?php

namespace App\Models\Blog;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'banner',
        'display_image',
        'status',
        'views',
        'tags',
    ];

    protected $casts = [
        'tags'=> 'array',
    ];


    public function categories()
    {
        return $this->hasOne(Category::class,'id','categories_id')->withDefault();
    }

    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }

    public function tags()
    {
        return $this->hasMany(Tags::class,'id','tags_id');
    }

}
