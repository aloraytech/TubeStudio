<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'webtube','type'=>'tube','version'=>'v.0.1','author_url'=>'https://aloraytech.com','active'=>true,'status'=>true],
            ['name' => 'streamit','type'=>'tube','version'=>'v.0.1','author_url'=>'','active'=>true,'status'=>true],
            ['name' => 'webblog','type'=>'blog','version'=>'v.0.1','author_url'=>'https://aloraytech.com','active'=>false,'status'=>false],
            ['name' => 'webshop','type'=>'shop','version'=>'v.0.1','author_url'=>'https://aloraytech.com','active'=>false,'status'=>false],
        ];

        DB::table('themes')->insert($data);
    }
}
