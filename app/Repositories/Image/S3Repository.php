<?php

declare(strict_types=1);

namespace App\Repositories\Image;

interface S3Repository
{
    /**
     * アップロード用の署名付きURLを発行
     *
     * @param string $disk
     * @param string $path
     * @return string
     */
    public function generateUploadUrl(string $disk, string $path): string;
}