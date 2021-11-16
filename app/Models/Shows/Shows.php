<?php

namespace App\Models\Shows;

use App\Models\Category\Category;
use App\Models\Movies\Videos;
use App\Models\System\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shows extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner',
        'desc',
        'tags',
        'display_image'
    ];

    protected $casts = [
      'tags'=> 'array',
    ];


    public function categories()
    {
        return $this->hasOne(Category::class,'id','categories_id');
    }

    public function seasons()
    {
        return $this->hasMany(Seasons::class);
    }

    public function videos()
    {
        return $this->hasOne(Videos::class,'id','trailer');
    }

    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }


}
