<?php

namespace App\Models\Category;

use App\Models\Movies\Movies;
use App\Models\Posts;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];


    public function movie()
    {
        return $this->belongsToMany(Movies::class);
    }


    public function shows()
    {
        return $this->belongsToMany(Shows::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Posts::class);
    }

}
