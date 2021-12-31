<?php

namespace Database\Factories\Category;

use App\Models\Blog\Posts;
use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{

    protected $model =  Tags::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'slug' => $this->faker->word(),
        ];
    }
}
