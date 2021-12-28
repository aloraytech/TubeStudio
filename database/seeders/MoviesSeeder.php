<?php

namespace Database\Seeders;

use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tag;

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
            ->count(20)
            ->create();

    }
}
