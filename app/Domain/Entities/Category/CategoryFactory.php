<?php

declare(strict_types=1);

namespace App\Domain\Entities\Category;

use App\Domain\ValueObjects\Category\CategoryId;
use App\Domain\ValueObjects\Category\CategoryName;
use App\Models\Category;

class CategoryFactory
{
  /**
   * Entity生成
   *
   * @param Category $category
   * @return CategoryEntity
   */
  public static function createProfile(Category $category): CategoryEntity
  {
    return new CategoryEntity(
        CategoryId::create($category->id),
        CategoryName::create($category->name),
    );
  }
}