<?php

namespace Database\Factories\Shows;

use App\Models\Category\Category;
use App\Models\Category\ShowsTags;
use App\Models\Category\Tags;
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
            'banner' => $this->faker->imageUrl(1920,1080),
            'desc' => $this->faker->text(),
            'tags'=> json_encode(Tags::factory()->create()->first()),
            'display_image' => $this->faker->imageUrl(477,432),
            'categories_id' => Category::factory(1)->state([
                'type' => 'show',
            ])->create()->first(),
            'age_group' => $this->faker->randomElement(['U','18+','Kids']),
            'trailer' => Videos::factory(1)->create()->first(),
            'release_on' => $this->faker->dateTime(),
            'views' => $this->faker->randomDigit(),
            'status'=> $this->faker->boolean(),
        ];
    }
}
