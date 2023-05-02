<?php

declare(strict_types=1);

namespace App\UseCases\Image\GeneratePreSignedUrl;

use App\Repositories\Image\S3Repository;
use App\Traits\GeneratePreSignedUrl\MakeS3FilePath;
use App\UseCases\Image\Inputs\GeneratePreSignedUrlInput;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GeneratePreSignedUrlUseCase implements GeneratePreSignedUrlUseCaseInterface
{
    use MakeS3FilePath;

    /**
     * @param S3Repository $s3Repository
     */
    public function __construct(private readonly S3Repository $s3Repository)
    {
    }

    private const DISK_NAME = 's3_private';

    private const S3_PATH = 'image';

    /**
     * {@inheritDoc}
     */
    public function execute(GeneratePreSignedUrlInput $input): array
    {
          $hashFileName = $this->getHashFileName($input->getExtension());
          $preSignedUrl = $this->generateUploadUrl($input->getId(), $hashFileName);
  
          return [
              'hash_file_name' => $hashFileName,
              'pre_signed_url' => $preSignedUrl,
          ];
    }

    /**
     * ハッシュ化したファイル名を作成
     *
     * @param string $extensition
     * @return string
     */
    private function getHashFileName(string $extensition): string
    {
        return Str::random(40) . '.' . $extensition;
    }

    /**
     * S3へ生成するパスを生成
     * S3へファイル格納
     *
     * @param string $id
     * @param string $hashFileName
     * @return string
     */
    private function generateUploadUrl(string $id, string $hashFileName): string
    {
        Log::info('generate s3 url', [
            'method' => __METHOD__,
            'id' => $id,
            'hash_file_name' => $hashFileName,
        ]);

        $path = $this->makeS3FilePath(self::S3_PATH, $id, $hashFileName);

        return $this->s3Repository->generateUploadUrl(self::DISK_NAME, $path);
    }
}