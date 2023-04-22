<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Profile;

class ProfileUserId
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param  string  $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
      return $this->value;
    }
}
