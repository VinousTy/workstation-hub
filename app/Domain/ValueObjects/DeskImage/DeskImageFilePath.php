<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\DeskImage;

class DeskImageFilePath
{
    /**
     * @param  string|null  $value
     */
    public function __construct(private readonly ?string $value = null)
    {
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public static function create(string|null $value): self
    {
        return new self($value);
    }

    /**
     * @return string|null
     */
    public function getValue(): string|null
    {
        return $this->value;
    }
}
