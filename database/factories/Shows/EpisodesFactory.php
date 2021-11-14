<?php

namespace Database\Factories\Shows;

use App\Models\Movies\Videos;
use App\Models\Shows\Episodes;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodesFactory extends Factory
{
    protected $model = Episodes::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(),
            'banner'=> $this->faker->randomLetter(10),
            'desc'=> $this->faker->text(200),
            'duration'=> $this->faker->time('i:s'),
            'release_on'=> $this->faker->dateTime(),
            'video_id'=> Videos::factory(1)->create()->first(),
        ];
    }
}
