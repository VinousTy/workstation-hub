<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\User;

class UserPassword
{
    /**
     * @var string|null
     */
    private ?string $value;

    /**
     * Undocumented function
     *
     * @param  string|null  $value
     */
    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public static function create(?string $value): self
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
