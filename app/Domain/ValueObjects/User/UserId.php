<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\User;

class UserId
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return self
     */
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