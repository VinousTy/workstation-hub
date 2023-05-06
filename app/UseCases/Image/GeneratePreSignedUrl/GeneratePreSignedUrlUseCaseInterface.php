<?php

declare(strict_types=1);

namespace App\UseCases\Image\GeneratePreSignedUrl;

use App\UseCases\Image\Inputs\GeneratePreSignedUrlInput;

interface GeneratePreSignedUrlUseCaseInterface
{
    public function execute(GeneratePreSignedUrlInput $input): array;
}
