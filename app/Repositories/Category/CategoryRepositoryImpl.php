<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Domain\Entities\Category\CategoryEntity;
use App\Domain\Entities\Category\CategoryFactory;
use App\Models\Category;

class CategoryRepositoryImpl implements CategoryRepository
{
    /**
     * {@inheritDoc}
     */
    public function firstOrCreate(array $names): CategoryEntity
    {
        foreach ($names as $name) {
          $category = Category::firstOrCreate([
              'name' => $name,
          ]);
        }

        return CategoryFactory::createCategory($category);
    }
}
