<?php

declare(strict_types=1);

namespace App\Repositories\DeskCategory;

use App\Domain\ValueObjects\Category\CategoryId;
use App\Models\Desk;

interface DeskCategoryRepository
{
    /**
     * 中間テーブルにデータを登録
     *
     * @param  Desk  $desk
     * @param  CategoryId  $categoryId
     * @return void
     */
    public function storeDeskCategory(Desk $desk, CategoryId $categoryId): void;
}
