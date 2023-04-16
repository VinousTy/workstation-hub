<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Profile\ProfileHeight;
use App\Enums\Profile\ProfileWeight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::pluck('id')->all();

        return [
            'user_id' => $this->faker->randomElement($users),
            'height' => $this->faker->randomElement(ProfileHeight::getHeight()),
            'weight' => $this->faker->randomElement(ProfileWeight::getWeight()),
            'account' => $this->faker->url,
            'introduction' => $this->faker->realText(),
        ];
    }
}
