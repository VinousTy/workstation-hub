<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Profile;

class ProfileWeight
{
    /**
     * @var int|null
     */
    private int|null $value;

    /**
     * @param  int|null  $value
     */
    public function __construct(int|null $value)
    {
        $this->value = $value;
    }

    /**
     * @param  int|null  $value
     * @return self
     */
    public static function create(int|null $value): self
    {
        return new self($value);
    }

    /**
     * @return int|null
     */
    public function getValue(): int|null
    {
      return $this->value;
    }
}
