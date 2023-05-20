<?php

declare(strict_types=1);

namespace App\UseCases\Desk\Inputs;

class StoreDeskInput
{
    /**
     * @param  string|null  $description
     * @param  string  $categoryName
     */
    public function __construct(
      private readonly ?string $description,
      private readonly string $categoryName,
    ) {
    }

    /**
     * @return string|null
     */
    public function getDescription(): string|null
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
}
