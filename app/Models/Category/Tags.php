<?php

namespace App\Models\Category;

use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];



    public function movies()
    {

        return $this->belongsTo(Movies::class)->whereJsonContains('tags',$this->toArray($this->tags));
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
