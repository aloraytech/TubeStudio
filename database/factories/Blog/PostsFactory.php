<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Posts;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    protected $model = Posts::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'desc' => $this->faker->text(200),
            'categories_id' => Category::factory(1)->state([
                'type' => 'blog',
            ])->create()->first(),
            'banner' => $this->faker->imageUrl(),
            'display_image' => $this->faker->imageUrl(),
            'tags' => $this->faker->words(10),
        ];
    }
}
