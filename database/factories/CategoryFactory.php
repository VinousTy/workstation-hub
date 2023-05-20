<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Category\CategoryName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private $currentIndex = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categoryNames = CategoryName::getCategoryName();

        return [
            'name' => $categoryNames[$this->currentIndex++],
        ];
    }
}
