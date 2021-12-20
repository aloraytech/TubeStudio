<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App/Models/Blog/Pages
 * @property $default_view
 * @property $url
 * @property $title
 * @property $target
 * @property $status
 * @property $desc
 * @property $position
 */
class Pages extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = [
        'title',
        'desc',
        'position',
        'url',
        'target',
        'default_view',
        'status',
        'views'
    ];



}
