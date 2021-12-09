<?php

namespace Database\Factories\System;

use App\Models\System\Members;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MembersFactory extends Factory
{
    protected $model = Members::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $this->faker->password(),
            'remember_token' => Str::random(10),
        ];
    }
}
