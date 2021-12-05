<?php

namespace Database\Factories\Category;

use App\Models\Category\Tags;
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
            'name' => $this->faker->word(),
            'status'=> $this->faker->boolean(),
        ];
    }
}
