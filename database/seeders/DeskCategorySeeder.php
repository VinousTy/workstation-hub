<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Desk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deskIds = Desk::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        foreach ($deskIds as $deskId) {
            // 1つのdeskに2つのカテゴリを紐づけるためにcategoryIdsからrandomに2つ抽出
            $selectedCategoryIds = array_rand($categoryIds, 2);

            foreach ($selectedCategoryIds as $categoryId) {
              DB::table('desk_category')->insert([
                  'desk_id' => $deskId,
                  'category_id' => $categoryIds[$categoryId],
                  'created_at' => now(),
                  'updated_at' => now(),
              ]);
            }
        }
    }
}
