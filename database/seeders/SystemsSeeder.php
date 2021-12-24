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
                'coming_soon' => false,
                'coming_soon_upto' => date('Y-m-d h:m:s'),
                'per_page' => 10,
                'player_size' => '21by9',
                'login_bg'=> 'https://via.placeholder.com/1024X682?text=Signin Background',
                'signup_bg'=>'https://via.placeholder.com/1024X682?text=Signup Background',
                'index_bg'=>'https://via.placeholder.com/1920X900?text=Landing Background',
                'themes_id' => 1,
                'has_slider' => true,
                'has_upcoming' => true,
                'movie_pack' =>  true,
                'show_pack' =>  true,
                'trailer_pack' => true,
                'blog_pack' =>  true,
                'advert_pack' =>  true,
                'social_pack' => false,
                'shop_pack' => false,
                'private_pack' => false,
                'payment_pack' => false,
                'activity_pack' => true,
                'installed' => true,
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
