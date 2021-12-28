<?php

namespace App\Models\Shows;

use App\Models\Category\Category;
use App\Models\Category\ShowsTags;
use App\Models\Category\Tags;
use App\Models\Movies\Videos;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $categories_id
 * @property $videos_id
 * @property $id
 * @property $name
 * @property $release_on
 * @property $banner
 * @property $display_image
 * @property $status
 * @property $tags
 */
class Shows extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner',
        'desc',
        'tags',
        'private',
        'display_image',
        'release_on',
        'age_group',
        'duration',
        'status',
    ];

    protected $casts = [
      'tags'=> 'array',
    ];



    public function categories()
    {
        return $this->hasOne(Category::class,'id','categories_id')->withDefault();

    }

    public function seasons()
    {
        return $this->hasMany(Seasons::class);
    }

//    public function oldestSeason()
//    {
//        return $this->seasons()->oldest('seasons.created_at');
//    }


    public function trailers()
    {
        return $this->hasMany(Trailers::class,'id','trailer');
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
