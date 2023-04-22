<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Profile;

class ProfileAccount
{
    /**
     * @var string|null
     */
    private string|null $value;

    /**
     * @param  string|null  $value
     */
    public function __construct(string|null $value)
    {
        $this->value = $value;
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
