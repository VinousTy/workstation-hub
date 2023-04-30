<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAuthUserProfileRequest;
use App\UseCases\Profile\Inputs\UpdateAuthUserProfileInput;
use App\UseCases\Profile\Outputs\GetAuthUserProfileOutput;
use App\UseCases\Profile\UpdateAuthUserProfile\UpdateAuthUserProfileUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateAuthUserProfileController extends Controller
{
    /**
     * @param  UpdateAuthUserProfileUseCaseInterface  $updateAuthUserProfileUseCaseInterface
     */
    public function __construct(
      private readonly UpdateAuthUserProfileUseCaseInterface $updateAuthUserProfileUseCaseInterface
    ) {
    }

    /**
     * プロフィール情報を更新
     *
     * @param  UpdateAuthUserProfileRequest  $request
     * @return JsonResponse
     */
    public function __invoke(UpdateAuthUserProfileRequest $request)
    {
        $profileEntity = $this->updateAuthUserProfileUseCaseInterface
            ->execute(new UpdateAuthUserProfileInput(
                id: $request->getParameter(),
                filePath: $request->getFilePath(),
                height: $request->getHeight(),
                weight: $request->getWeight(),
                account: $request->getAccount(),
                introduction: $request->getIntroduction(),
            ));

        return response()->json([
          'profile' => ( new GetAuthUserProfileOutput(
              $profileEntity->getId()->getValue(),
              $profileEntity->getUserId()->getValue(),
              $profileEntity->getFilePath()->getValue(),
              $profileEntity->getHeight()->getValue(),
              $profileEntity->getWeight()->getValue(),
              $profileEntity->getAccount()->getValue(),
              $profileEntity->getIntroduction()->getValue(),
            ))->toArray(),
          'message' => __('message.success.profile.update')
        ], Response::HTTP_OK);
    }
}
