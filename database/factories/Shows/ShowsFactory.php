<?php

namespace Database\Factories\Shows;

use App\Models\Category\Category;
use App\Models\Movies\Videos;
use App\Models\Shows\Shows;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowsFactory extends Factory
{
    protected $model = Shows::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'banner' => $this->faker->imageUrl(),
            'desc' => $this->faker->text(),
            'tags' => $this->faker->words(10),
            'display_image' => $this->faker->imageUrl(),
            'categories_id' => Category::factory(1)->state([
                'type' => 'show',
            ])->create()->first(),
            'age_group' => $this->faker->randomElement(['U','18+','Kids']),
            'trailer' => Videos::factory(1)->create()->first(),
            'release_on' => $this->faker->dateTime(),
        ];
    }
}
