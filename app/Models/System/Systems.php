<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
    * @property $slogan
    * @property $favicon
    * @property $logo
    * @property $keywords
    * @property $desc
    * @property $header
    * @property $lang
    * @property $coming_soon
    * @property $coming_soon_upto
    * @property $per_page
    * @property $player_size
    * @property $login_bg
    * @property $signup_bg
    * @property $index_bg
    * @property $has_slider
    * @property $has_upcoming
    * @property $movie_pack
    * @property $show_pack
    * @property $trailer_pack
    * @property $blog_pack
    * @property $advert_pack
    * @property $social_pack
    * @property $shop_pack
    * @property $private_pack
    * @property $payment_pack
    * @property $activity_pack
    * @property $installed
    * @property $secret
    * @property $valid_secret
    * @property $valid_upto
    * @property $client_email
    * @property $themes_id
 */
class Systems extends Model
{
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = [
        'slogan',
        'favicon',
        'logo',
        'keywords',
        'desc',
        'header',
        'lang',
        'coming_soon',
        'coming_soon_upto',
        'per_page',
        'player_size',
        'login_bg',
        'signup_bg',
        'index_bg',
        'has_slider',
        'has_upcoming',
        'movie_pack',
        'show_pack',
        'trailer_pack',
        'blog_pack',
        'advert_pack',
        'social_pack',
        'shop_pack',
        'private_pack',
        'payment_pack',
        'activity_pack',
        'installed',
        'secret',
        'valid_secret',
        'valid_upto',
        'client_email',
    ];




    public function themes()
    {
        return $this->hasOne(Themes::class,'id','themes_id')->withDefault();
    }



}
