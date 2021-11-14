<?php

namespace Database\Seeders;

use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use Database\Factories\Shows\ShowsFactory;
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
            ->count(10)
//            ->hasSeasons(5)
            ->has(Seasons::factory()
//                ->hasEpisodes(5)
                ->has(Episodes::factory()
                    ->count(5),'episodes')
                ->count(5),'seasons')
            ->create();
    }
}
