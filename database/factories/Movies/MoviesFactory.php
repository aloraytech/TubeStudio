<?php

namespace Database\Factories\Movies;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\DocBlock\Tag;

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
                'type' => 'movie',
            ])->create()->first(),
            'videos_id' => Videos::factory(1)->create()->first(),
            'banner' => $this->faker->imageUrl(1920,1080),
            'display_image' => $this->faker->imageUrl(477,432),
            'desc' => $this->faker->realText(200),
            'tags'=> json_encode(Tags::factory()->create()->first()),
            'age_group' => $this->faker->randomElement(['U','18+','Kids']),
            'release_on' => $this->faker->dateTime(),
            'duration'=> $this->faker->time('i:s'),
            'views' => $this->faker->randomDigit()
        ];
    }
}
