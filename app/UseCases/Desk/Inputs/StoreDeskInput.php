<?php

declare(strict_types=1);

namespace App\UseCases\Desk\Inputs;

class StoreDeskInput
{
    /**
     * @param  string|null  $description
     * @param  array  $categoryName
     */
    public function __construct(
      private readonly ?string $description,
      private readonly array $categoryNames,
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
     * @return array
     */
    public function getCategoryNames(): array
    {
        return $this->categoryNames;
    }
}
