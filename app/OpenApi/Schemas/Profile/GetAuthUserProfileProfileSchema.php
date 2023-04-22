<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\Profile;

use App\Abstract\AbstractSchema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;

class GetAuthUserProfileProfileSchema extends AbstractSchema implements Reusable
{
    /**
     * @return string
     */
    protected function getObjectId(): string
    {
        return 'GetAuthUserProfileProfile';
    }

    /**
     * @return array
     */
    protected function getProperties(): array
    {
      return [
          ProfileSchema::id(),
          ProfileSchema::userId(),
          ProfileSchema::filePath(),
          ProfileSchema::height(),
          ProfileSchema::weight(),
          ProfileSchema::account(),
          ProfileSchema::introduction(),
      ];
    }
}
