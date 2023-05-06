<?php

declare(strict_types=1);

namespace App\UseCases\Image\UploadImage;

use App\UseCases\Image\Inputs\UploadImageInput;

interface UploadImageUseCaseInterface
{
    public function execute(UploadImageInput $input);
}
