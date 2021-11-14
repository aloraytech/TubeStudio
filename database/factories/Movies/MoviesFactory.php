<?php

namespace Database\Factories\Movies;

use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoviesFactory extends Factory
{
    protected $model = Movies::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'quality' => $this->faker->randomElement(['720p','460p','1080p']),
            'categories_id' => Category::factory(1)->state([
                'type' => 'movies',
            ])->create()->first(),
            'videos_id' => Videos::factory(1)->create()->first(),
            'banner' => $this->faker->randomLetter(),
            'desc' => $this->faker->text(200),
            'tags' => $this->faker->randomLetter(),
            'release_on' => $this->faker->dateTime(),
        ];
    }
}
