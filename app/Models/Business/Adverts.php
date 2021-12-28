<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'position',
        'provider',
        'banner',
        'code',
        'target_url',
        'target_view',
        'target_click',
        'target_county',
        'views',
        'clicks',
        'status'
    ];


}
