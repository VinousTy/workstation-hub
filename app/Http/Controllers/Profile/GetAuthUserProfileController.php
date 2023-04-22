<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\UseCases\Profile\GetAuthUserProfile\GetAuthUserProfileUseCaseInterface;
use App\UseCases\Profile\Outputs\GetAuthUserProfileOutput;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
