<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Profile\ProfileHeight;
use App\Enums\Profile\ProfileWeight;
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
        return [
            'height' => $this->faker->randomElement(ProfileHeight::getHeight()),
            'weight' => $this->faker->randomElement(ProfileWeight::getWeight()),
            'account' => $this->faker->url,
            'introduction' => $this->faker->realText(),
        ];
    }
}
