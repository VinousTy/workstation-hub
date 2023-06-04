<?php

declare(strict_types=1);

namespace App\Repositories\Image;

use App\Domain\Entities\Profile\ProfileEntity;

interface ImageRepository
{
    /**
     * 画像を保存
     *
     * @param  string  $id
     * @param  string  $filePath
     * @return ProfileEntity
     */
    public function uploadImageFile(string $id, string $filePath): ProfileEntity;

    /**
     * デスク画像を保存
     *
     * @param  string  $deskId
     * @param  string  $filePath
     * @return void
     */
    public function uploadDeskImageFile(string $deskId, string $fileName, string $extension, string $filePath): void;
}
