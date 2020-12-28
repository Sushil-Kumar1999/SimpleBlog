<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            "about" => $this->faker->sentence,
            "last_active" => $this->faker->dateTime('now'),
            "user_id" => User::factory()->create()->id
        ];
    }
}
