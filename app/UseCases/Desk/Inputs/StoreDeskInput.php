<?php

declare(strict_types=1);

namespace App\UseCases\Desk\Inputs;

class StoreDeskInput
{
    /**
     * @param  array  $files
     * @param  array  $extensions
     * @param  string  $type
     * @param  string|null  $description
     * @param  array  $categoryNames
     */
    public function __construct(
      private readonly array $files,
      private readonly array $extensions,
      private readonly string $type,
      private readonly ?string $description,
      private readonly array $categoryNames,
    ) {
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
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
