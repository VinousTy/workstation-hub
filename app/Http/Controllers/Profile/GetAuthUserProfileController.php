<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Profile\GetAuthUserProfileResponse;
use App\UseCases\Profile\GetAuthUserProfile\GetAuthUserProfileUseCaseInterface;
use App\UseCases\Profile\Outputs\GetAuthUserProfileOutput;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class GetAuthUserProfileController extends Controller
{
    /**
     * @param  GetAuthUserProfileUseCaseInterface  $getAuthUserProfileUseCaseInterface
     */
    public function __construct(private readonly GetAuthUserProfileUseCaseInterface $getAuthUserProfileUseCaseInterface)
    {
    }

    /**
     * プロフィール情報取得
     *
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['profile'])]
    #[OpenApi\Response(factory: GetAuthUserProfileResponse::class)]
    public function __invoke(): JsonResponse
    {
        $profileEntity = $this->getAuthUserProfileUseCaseInterface->execute();

        return response()->json((new GetAuthUserProfileOutput(
            $profileEntity->getId()->getValue(),
            $profileEntity->getUserId()->getValue(),
            $profileEntity->getFilePath()->getValue(),
            $profileEntity->getHeight()->getValue(),
            $profileEntity->getWeight()->getValue(),
            $profileEntity->getAccount()->getValue(),
            $profileEntity->getIntroduction()->getValue(),
          ))->toArray(), Response::HTTP_OK);
    }
}
