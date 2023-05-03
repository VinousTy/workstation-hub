<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadImageRequest;
use App\UseCases\Image\Inputs\UploadImageInput;
use App\UseCases\Image\UploadImage\UploadImageUseCaseInterface;
use App\UseCases\Profile\Outputs\GetAuthUserProfileOutput;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UploadImageController extends Controller
{
    /**
     * @param  UploadImageUseCaseInterface  $uploadImageUseCaseInterface
     */
    public function __construct(
        private readonly UploadImageUseCaseInterface $uploadImageUseCaseInterface
    ) {
    }

    /**
     * ファイルのアップロード
     *
     * @param  UploadImageRequest  $request
     * @return JsonResponse
     */
    public function __invoke(UploadImageRequest $request): JsonResponse
    {
        $profileEntity = $this->uploadImageUseCaseInterface
          ->execute(new UploadImageInput(
              $request->getParameter(),
              $request->getExtension(),
              $request->getHashFileName(),
          ));

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
