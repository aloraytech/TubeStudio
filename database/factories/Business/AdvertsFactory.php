<?php

namespace Database\Factories\Business;

use App\Models\Business\Adverts;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertsFactory extends Factory
{
    protected $model = Adverts::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position'=> $this->faker->randomElement(['top','right_side','left_side','in_desc','footer']),
            'provider'=> $this->faker->randomElement(['google','medianet','chitika']),
            'banner'=> $this->faker->imageUrl(),
            'code'=> $this->faker->text(150),
            'target_url' => $this->faker->url(),
        ];
    }
}
