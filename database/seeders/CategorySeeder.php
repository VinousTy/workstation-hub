<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Category\CategoryName;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(count(CategoryName::getCategoryName()))->create();
    }
}
