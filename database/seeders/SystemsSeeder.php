<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class SystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_date = Date::today();

        $data = [
            [
                'slogan' => 'Your Business WebSuite',
                'favicon' => 'https://via.placeholder.com/150x150.png/FF0000/FFFFFF?text=WebSuite',
                'logo' => 'https://via.placeholder.com/350x150.png/FF0000/FFFFFF?text=WebSuite',
                'keywords' => json_encode(['video','movie','webtube','web gallery','video gallery']),
                'desc' => 'Get Trending TV Shows, Movies, Kids Favourite, Web Series, Family Drama etc',
                'header' => 'your meta details',
                'lang' => 'en',
                'coming_soon' => 0,
                'coming_soon_upto' => date('Y-m-d h:m:s'),
                'per_page' => 10,
                'player_size' => '21by9',
                'login_bg'=> 'https://via.placeholder.com/1024X682?text=Signin Background',
                'signup_bg'=>'https://via.placeholder.com/1024X682?text=Signup Background',
                'index_bg'=>'https://via.placeholder.com/1920X900?text=Landing Background',
                'themes_id' => 1,
                'has_slider' => 0,
                'has_upcoming' => 0,
                'movie_pack' => 1,
                'show_pack' => 1,
                'trailer_pack' => 1,
                'blog_pack' => 1,
                'advert_pack' => 1,
                'social_pack' => 0,
                'shop_pack' => 0,
                'private_pack' => 0,
                'payment_pack' => 0,
                'activity_pack' => 1,
                'installed' => 1,
                'secret' => '****-****-****-****',
                'valid_secret' => true,
                'valid_upto' => $_date->addRealYears(10),
                'client_email' => 'demo_client@aloraytech.in',
                'contact_us' => 'contact_us@'.config('app.url'),
                'version'=> 'v.1.0',
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
            ]

        ];

        DB::table('systems')->insert($data);
    }
}
