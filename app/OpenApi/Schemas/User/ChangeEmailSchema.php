<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\User;

use App\Abstract\AbstractSchema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;

class ChangeEmailSchema extends AbstractSchema implements Reusable
{
    /**
     * @return string
     */
    protected function getObjectId(): string
    {
        return 'ChangeEmail';
    }

    /**
     * @return array
     */
    protected function getProperties(): array
    {
      return [
          UserSchema::email(),
      ];
    }
}
