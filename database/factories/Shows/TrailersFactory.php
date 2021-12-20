<?php

namespace Database\Factories\Shows;

use App\Models\Movies\Videos;
use App\Models\Shows\Trailers;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrailersFactory extends Factory
{
    protected $model =  Trailers::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(),
            'display_image'=> $this->faker->imageUrl(744,432),
            'desc'=> $this->faker->text(),
            'duration'=> $this->faker->time('i:s'),
            'videos_id'=> Videos::factory(1)->create()->first(),
        ];
    }
}
