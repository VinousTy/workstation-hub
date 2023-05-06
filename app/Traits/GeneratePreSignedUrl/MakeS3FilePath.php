<?php

declare(strict_types=1);

namespace App\Traits\GeneratePreSignedUrl;

trait MakeS3FilePath
{
    /**
     * S3に格納するファイルパス生成
     *
     * @param  string  $s3Path
     * @param  string  $id
     * @param  string  $hashFilePath
     * @return string
     */
    private function makeS3FilePath(string $s3Path, string $id, string $hashFilePath): string
    {
        return "$s3Path/$id/$hashFilePath";
    }
}
