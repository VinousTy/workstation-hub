<?php

 declare(strict_types=1);

namespace Database\Factories;

use App\Models\Desk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeskImage>
 */
class DeskImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $deskIds = Desk::pluck('id');

        return [
            'desk_id' => $this->faker->randomElement($deskIds),
            'file_name' => 'ダミーファイル',
            'extension' => $this->faker->randomElement(['jpg', 'jpeg', 'png']),
            'file_path' => $this->faker->url,
        ];
    }
}
