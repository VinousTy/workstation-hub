<?php

declare(strict_types=1);

namespace App\UseCases\Image\GeneratePreSignedUrl;

use App\Exceptions\Image\GenerateUrlException;
use App\Repositories\Image\S3Repository;
use App\Traits\GeneratePreSignedUrl\MakeS3FilePath;
use App\UseCases\Image\Inputs\GeneratePreSignedUrlInput;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GeneratePreSignedUrlUseCase implements GeneratePreSignedUrlUseCaseInterface
{
    use MakeS3FilePath;

    /**
     * @param  S3Repository  $s3Repository
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
        try {
          $extensions = $input->getExtensions();
          $hashFileNames = [];
          $preSignedUrls = [];

          foreach ($extensions as $extension) {
            $hashFileName = $this->getHashFileName($extension);
            $preSignedUrl = $this->generateUploadUrl($input->getId(), $input->getType(), $hashFileName);

            $hashFileNames[] = $hashFileName;
            $preSignedUrls[] = $preSignedUrl;
          }

          return [
              'hash_file_name' => $hashFileNames,
              'pre_signed_url' => $preSignedUrls,
          ];
        } catch (S3Exception $e) {
          Log::error(__('exception.pre_signed_url.failed'), [
              'method' => __METHOD__,
              'error' => $e,
              'parent_id' => $input->getId(),
              'extension' => $input->getExtensions(),
          ]);

          throw new GenerateUrlException(__('exception.pre_signed_url.failed'));
        }
    }

    /**
     * ハッシュ化したファイル名を作成
     *
     * @param  string  $extensition
     * @return string
     */
    private function getHashFileName(string $extensition): string
    {
        return Str::random(40).'.'.$extensition;
    }

    /**
     * S3へ生成するパスを生成
     * S3へファイル格納
     *
     * @param  string  $id
     * @param  string  $hashFileName
     * @return string
     */
    private function generateUploadUrl(string $id, string $type, string $hashFileName): string
    {
        Log::info('generate s3 url', [
            'method' => __METHOD__,
            'id' => $id,
            'type' => $type,
            'hash_file_name' => $hashFileName,
        ]);

        $path = $this->makeS3FilePath(self::S3_PATH, $id, $type, $hashFileName);

        return $this->s3Repository->generateUploadUrl(self::DISK_NAME, $path);
    }
}
