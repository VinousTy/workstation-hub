<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Domain\Entities\Category\CategoryEntity;
use App\Domain\ValueObjects\Category\CategoryName;

interface CategoryRepository
{
    /**
     * カテゴリを作成または既存のカテゴリを取得
     *
     * @param  CategoryName  $name
     * @return CategoryEntity
     */
    public function firstOrCreate(CategoryName $name): CategoryEntity;
}
