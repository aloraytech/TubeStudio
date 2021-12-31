<?php

namespace Database\Seeders;

use App\Models\Blog\Posts;
use App\Models\Category\Tags;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posts::factory()->count(100)->create();
    }
}
