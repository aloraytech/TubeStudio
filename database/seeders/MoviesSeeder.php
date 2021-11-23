<?php

namespace Database\Seeders;

use App\Models\Movies\Movies;
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
            ->count(250)
            ->create();

    }
}
