<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\User;

use App\Abstract\AbstractSchema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;

class ChangePasswordSchema extends AbstractSchema implements Reusable
{
    /**
     * @return string
     */
    protected function getObjectId(): string
    {
        return 'ChangePassword';
    }

    /**
     * @return array
     */
    protected function getProperties(): array
    {
      return [
          UserSchema::password(),
      ];
    }
}
