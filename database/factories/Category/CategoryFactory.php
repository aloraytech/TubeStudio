<?php

namespace Database\Factories\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model =  Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(),
            'type'=> $this->faker->randomElement(['movie','show','blog']),
            'banner' => $this->faker->image(),
            'desc' => $this->faker->realText(),
        ];
    }
}
