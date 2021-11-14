<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use Database\Factories\Category\CategoryFactory;
use Database\Factories\Movies\VideosFactory;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Movies::factory()
            ->count(10)
            ->create();

    }
}
