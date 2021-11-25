<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $data = [
            [
                'slogan' => 'Your Video Gallery',
                'favicon'=> 'https://via.placeholder.com/150x150.png/FF0000/FFFFFF?text=WebTube',
                'logo'=> 'https://via.placeholder.com/350x150.png/FF0000/FFFFFF?text=WebTube',
                'keywords'=> json_encode(['video','movie','webtube','web gallery','video gallery']),
                'desc' => 'Get Trending TV Shows, Movies, Kids Favourite, Web Series, Family Drama etc',
                'header'=>'landing.png',
                'login_bg'=> 'https://via.placeholder.com/1024X682?text=Signin Background',
                'signup_bg'=>'https://via.placeholder.com/1024X682?text=Signup Background',
                'index_bg'=>'https://via.placeholder.com/1920X900?text=Landing Background',
                'private'=>0,
                'coming_soon'=>0,
                'coming_soon_upto' => date('Y-m-d h:m:s'),
                'installed'=>1,
                'slider'=>1,
                'per_page'=>10,
                'theme' => 'streamit',
                'player_size'=>'21by9',
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
            ],

        ];

        DB::table('systems')->insert($data);
    }
}
