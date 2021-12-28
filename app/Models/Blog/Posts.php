<?php

namespace App\Models\Blog;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
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
        'age_group',
        'release_on',
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
//        return $this->hasMany(Tags::class,'id')->find($tag_list);

        $related = $this->hasMany(Tags::class);
        $related->setQuery(
            Tags::whereIn('id', $this->tags)->getQuery()
        );

        return $related;


    }

}
