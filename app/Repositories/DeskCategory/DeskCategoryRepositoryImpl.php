<?php

declare(strict_types=1);

namespace App\Repositories\DeskCategory;

use App\Domain\ValueObjects\Category\CategoryId;
use App\Models\Desk;

class DeskCategoryRepositoryImpl implements DeskCategoryRepository
{
    /**
     * {@inheritDoc}
     */
    public function storeDeskCategory(Desk $desk, CategoryId $categoryId): void
    {
        $desk->categories()->attach($categoryId->getValue());
    }
}
