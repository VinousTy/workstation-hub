<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\GeneratePreSignedUrlRequest;
use App\UseCases\Image\GeneratePreSignedUrl\GeneratePreSignedUrlUseCaseInterface;
use App\UseCases\Image\Inputs\GeneratePreSignedUrlInput;
use Illuminate\Http\Request;

class GeneratePreSignedUrlController extends Controller
{
    /**
     * @param GeneratePreSignedUrlUseCaseInterface $generatePreSignedUrlUseCaseInterface
     */
    public function __construct(
      private readonly GeneratePreSignedUrlUseCaseInterface $generatePreSignedUrlUseCaseInterface
    )
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(GeneratePreSignedUrlRequest $request)
    {
       return $this->generatePreSignedUrlUseCaseInterface
          ->execute(new GeneratePreSignedUrlInput(
              $request->getParameter(),
              $request->getExtension(),
          ));
    }
}
