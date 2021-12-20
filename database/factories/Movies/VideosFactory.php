<?php

namespace Database\Factories\Movies;

use App\Models\Movies\Videos;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideosFactory extends Factory
{

    protected $model = Videos::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'author' => $this->faker->name(),
            'channel' => $this->faker->word(),
            'height' => 400,
            'width' => 640,
            'provider' => $this->faker->randomElement(['youtube','dailymotion','facebook']),
            'thumb_url' => $this->faker->imageUrl(),
            'thumb_h' => 200,
            'thumb_w' => 300,
            'code' => $this->faker->randomHtml(),
            'url_path' => $this->faker->unique()->url(),
        ];
    }
}
