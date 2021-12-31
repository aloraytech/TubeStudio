<?php

namespace App\Models\Category;

use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

/**
 *
 * @property $type
 * @property $id
 * @property $name
 * @property $parent_id
 * @property $banner
 * @property $parent
 * @property $movies
 * @property $shows
 * @property $posts
 */
class Category extends Model
{
    use HasFactory,
        AsSource,Attachable;

    public const MOVIE = 'movie';
    public const SHOW='show';
    public const BLOG='blog';

    protected $fillable = [
        'name',
        'type',
        'banner',
        'parent_id',
        'desc',
    ];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class,'id','parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function movies()
    {
        return $this->belongsTo(Movies::class,'id','categories_id')->withDefault();
    }


    /**
     * @return BelongsTo
     */
    public function shows()
    {
        return $this->belongsTo(Shows::class,'id','categories_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function posts()
    {
        return $this->belongsTo(Posts::class,'id','categories_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function banners()
    {
        //return $this->belongsToMany(Attachment::class,'attachments','id','banner','banner');
        return $this->hasOne(Attachment::class, 'id', 'banner')->withDefault();
    }

}
