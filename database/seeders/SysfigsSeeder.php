<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysfigsSeeder extends Seeder
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
//                'id' =>1,
                'slogan' => 'Your Video Gallery',
                'favicon'=> 'favicon.ico',
                'keywords'=> json_encode(['video','movie','webtube','web gallery','video gallery']),
                'header'=>'landing.png',
                'login_bg'=> 'https://via.placeholder.com/1024X682?text=Signin Background',
                'signup_bg'=>'https://via.placeholder.com/1024X682?text=Signup Background',
                'index_bg'=>'https://via.placeholder.com/1920X900?text=Landing Background',
                'private'=>1,
                'coming_soon'=>1,
                'installed'=>1,
                'slider'=>1,
                'slider_limit'=>1,
                'per_page'=>10,
                'player_size'=>'21by9',
                'created_at'=> date('Y-m-d h:m:s'),
                'updated_at'=> date('Y-m-d h:m:s'),
                ],

        ];

        DB::table('sysfigs')->insert($data);
    }
}
