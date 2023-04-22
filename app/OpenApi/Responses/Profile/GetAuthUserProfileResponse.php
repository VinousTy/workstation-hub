<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Profile;

use App\OpenApi\Schemas\Profile\GetAuthUserProfileProfileSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class GetAuthUserProfileResponse extends ResponseFactory
{
    public function build(): Response
    {
      return Response::ok('GetAuthUserProfileProfile')
        ->content(
            MediaType::json()->schema(GetAuthUserProfileProfileSchema::ref())
        );
    }
}
