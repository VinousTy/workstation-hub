<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Inputs;

class ChangePasswordInput
{
    /**
     * @var string
     */
    private string $password;

    /**
     * @param  string  $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
      return $this->password;
    }
}
