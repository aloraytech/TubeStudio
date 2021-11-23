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
            'banner'=> $this->faker->imageUrl(),
            'desc'=> $this->faker->text(200),
            'duration'=> $this->faker->time('i:s'),
            'videos_id'=> Videos::factory(1)->create()->first(),
        ];
    }
}
