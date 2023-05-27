<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\GeneratePreSignedUrlRequest;
use App\UseCases\Image\GeneratePreSignedUrl\GeneratePreSignedUrlUseCaseInterface;
use App\UseCases\Image\Inputs\GeneratePreSignedUrlInput;
use App\UseCases\Image\Outputs\GeneratePreSignedUrlOutput;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GeneratePreSignedUrlController extends Controller
{
    /**
     * @param  GeneratePreSignedUrlUseCaseInterface  $generatePreSignedUrlUseCaseInterface
     */
    public function __construct(
      private readonly GeneratePreSignedUrlUseCaseInterface $generatePreSignedUrlUseCaseInterface
    ) {
    }

    /**
     * 署名付きURLを生成
     *
     * @param  GeneratePreSignedUrlRequest  $request
     * @return JsonResponse
     */
    public function __invoke(GeneratePreSignedUrlRequest $request): JsonResponse
    {
       $preSignedResult = $this->generatePreSignedUrlUseCaseInterface
          ->execute(new GeneratePreSignedUrlInput(
              $request->getParameter(),
              $request->getExtensions(),
              $request->getType(),
          ));

        return response()->json((new GeneratePreSignedUrlOutput(
            $preSignedResult['hash_file_name'],
            $preSignedResult['pre_signed_url'],
        ))->toArray(), Response::HTTP_OK);
    }
}
