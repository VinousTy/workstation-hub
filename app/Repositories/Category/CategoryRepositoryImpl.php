<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Domain\Entities\Category\CategoryEntity;
use App\Domain\Entities\Category\CategoryFactory;
use App\Domain\ValueObjects\Category\CategoryName;
use App\Models\Category;

class CategoryRepositoryImpl implements CategoryRepository
{
    /**
     * {@inheritDoc}
     */
    public function firstOrCreate(CategoryName $name): CategoryEntity
    {
        $category = Category::firstOrCreate([
            'name' => $name->getValue(),
        ]);

        return CategoryFactory::createCategory($category);
    }
}
