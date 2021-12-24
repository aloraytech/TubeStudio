<?php

namespace Database\Seeders;

use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\Shows\Trailers;
use Illuminate\Database\Seeder;

class ShowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shows::factory()
            ->count(50)
            ->has(Seasons::factory()
                ->has(Episodes::factory()
                    ->count(10),'episodes')
                ->has(Trailers::factory()
                    ->count(5),'trailers')
                ->count(10),'seasons')
            ->create();
    }
}
