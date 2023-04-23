<?php

declare(strict_types=1);

namespace App\OpenApi\RequestBodies\User;

use App\OpenApi\Schemas\User\ChangePasswordSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class ChangePasswordRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
          ->content(
            MediaType::json()->schema(ChangePasswordSchema::ref())
          );
    }
}
