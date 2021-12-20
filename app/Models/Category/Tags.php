<?php

namespace App\Models\Category;

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
        return $this->belongsTo(Movies::class,'tags','id');
    }

    public function shows()
    {
        return $this->belongsTo(Shows::class,'tags','id');
    }





}
