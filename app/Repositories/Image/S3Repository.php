<?php

declare(strict_types=1);

namespace App\Repositories\Image;

use Illuminate\Http\UploadedFile;

interface S3Repository
{
    /**
     * アップロード用の署名付きURLを発行
     *
     * @param  string  $disk
     * @param  string  $path
     * @return string
     */
    public function generateUploadUrl(string $disk, string $path): string;

    /**
     * S3へアップロード
     *
     * @param  string  $disk
     * @param  string  $filePath
     * @param  UploadedFile  $file
     * @return void
     */
    public function uplloadS3(string $disk, string $filePath, UploadedFile $file): void;
}
