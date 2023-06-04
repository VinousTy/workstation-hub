<?php

declare(strict_types=1);

namespace App\UseCases\Image\UploadImage;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Repositories\Image\ImageRepository;
use App\Traits\GeneratePreSignedUrl\MakeS3FilePath;
use App\UseCases\Image\Inputs\UploadImageInput;

class UploadImageUseCase implements UploadImageUseCaseInterface
{
    use MakeS3FilePath;

    private const S3_PATH = 'image';

    /**
     * @param  ImageRepository  $imageRepository
     */
    public function __construct(private readonly ImageRepository $imageRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(UploadImageInput $input): ProfileEntity
    {
        $filePath = $this->makeS3FilePath(self::S3_PATH, $input->getId(), $input->getType(), $input->getHashFileName());

        return $this->imageRepository->uploadImageFile($input->getId(), $filePath);
    }
}
