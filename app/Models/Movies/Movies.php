<?php

namespace App\Models\Movies;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\System\Activities;
use App\Models\System\Stats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

/**
 * App/Models/Movies
 * @property $videos
 * @property $categories
 * @property $activities
 * @property $banner
 * @property $tags
 * @property $id
 * @property $name
 * @property $quality
 * @property $desc
 * @property $release_on
 * @property $duration
 * @property $videos_id
 * @property $categories_id
 */
class Movies extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'name',
        'quality',
        'banner',
        'display_image',
        'desc',
        'views',
        'age_group',
        'duration',
        'release_on',
        'status',
        'tags',
    ];
    protected $casts = [
        'tags'=> 'array',
    ];



    public function videos()
    {
        return $this->hasOne(Videos::class,'id','videos_id')->withDefault();
    }


    public function categories()
    {
        return $this->hasOne(Category::class,'id','categories_id')->withDefault();
    }

    public function stats()
    {
        return $this->hasMany(Stats::class,'movies_id','id');
    }


    public function banner()
    {
        return $this->hasOne(Attachment::class, 'id', 'banner')->withDefault();
    }

    public function tags()
    {
        return $this->hasMany(Tags::class,'id','tags');
    }


}
