<?php

namespace App\Models\Blog;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
    ];

    protected $casts = [
        'tags'=> 'array',
    ];


    public function categories()
    {
        return $this->hasOne(Category::class,'category_id')->withDefault();
    }



}
