<?php

declare(strict_types=1);

namespace App\Repositories\Image;

use Aws\S3\Exception\S3Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class S3RepositoryImpl implements S3Repository
{
    /**
     * {@inheritDoc}
     */
    public function generateUploadUrl(string $disk, string $path): string
    {
        Log::info('start generate s3 path', [
            'method' => __METHOD__,
            'path' => $path,
        ]);

        // s3クライアントを取得
        $client = Storage::disk($disk)->getClient();

        // 署名付きURLを生成
        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3_private.bucket'),
            'Key' => $path,
        ]);
        $expire = now()->addSeconds(config('s3.presigned_url.expire'));
        $generateUrl = $client->createPresignedRequest($command, $expire)
            ->getUri();

        Log::info('end generate s3 path', [
            'method' => __METHOD__,
            'path' => $path,
            'url' => $generateUrl,
        ]);

        return (string) $generateUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function uplloadS3(string $disk, string $filePath, UploadedFile $file): void
    {
      try {
        Storage::disk($disk)->putFile($filePath, $file);
      } catch (S3Exception $e) {
        Log::error(__('exception.image.desk.failed'), [
            'method' => __METHOD__,
            'file_path' => $filePath,
            'error_message' => $e->getMessage(),
            'exception_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'error_trace' => $e->getTrace(),
        ]);
      }
    }
}
