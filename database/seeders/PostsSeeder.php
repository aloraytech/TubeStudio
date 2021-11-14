<?php

namespace Database\Seeders;

use App\Models\Blog\Posts;
use Database\Factories\Blog\PostsFactory;
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
        Posts::factory()->count(10)->create();
    }
}
