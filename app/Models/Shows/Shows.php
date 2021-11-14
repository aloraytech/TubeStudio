<?php

namespace App\Models\Shows;

use App\Models\Category\Category;
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



    public function categories()
    {
        return $this->hasOne(Category::class);
    }

    public function seasons()
    {
        return $this->belongsToMany(Seasons::class,'show_season');
    }


}
