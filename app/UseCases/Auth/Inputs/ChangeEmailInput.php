<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Inputs;

class ChangeEmailInput
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @param  string  $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
      return $this->email;
    }
}
