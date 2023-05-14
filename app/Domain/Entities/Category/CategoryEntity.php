<?php

declare(strict_types=1);

namespace App\Domain\Entities\Category;

use App\Domain\ValueObjects\Category\CategoryId;
use App\Domain\ValueObjects\Category\CategoryName;

class CategoryEntity
{
  /**
   * @param  CategoryId  $id
   * @param  CategoryName  $name
   */
  public function __construct(
    private readonly CategoryId $id,
    private readonly CategoryName $name,
  ) {
  }

  /**
   * @return CategoryId
   */
  public function getId(): CategoryId
  {
      return $this->id;
  }

  /**
   * @return CategoryName
   */
  public function getName(): CategoryName
  {
      return $this->name;
  }

  /**
   * @return array
   */
  public function toArray(): array
  {
      return [
          'id' => $this->getId()->getValue(),
          'name' => $this->getName()->getValue(),
      ];
  }
}
