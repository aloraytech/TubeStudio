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
            ['name' => 'webtube','version'=>'v.0.1','author_url'=>'https://aloraytech.com','active'=>false,'status'=>true],
            ['name' => 'streamit','version'=>'v.0.1','author_url'=>'','active'=>true,'status'=>true],

        ];

        DB::table('themes')->insert($data);
    }
}
