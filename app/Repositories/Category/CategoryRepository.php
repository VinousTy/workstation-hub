<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Domain\Entities\Category\CategoryEntity;

interface CategoryRepository
{
    /**
     * カテゴリを作成または既存のカテゴリを取得
     *
     * @param  array  $name
     * @return CategoryEntity
     */
    public function firstOrCreate(array $names): CategoryEntity;
}
