<?php

declare(strict_types=1);

namespace App\Domain\Entities\DeskImage;

use App\Domain\ValueObjects\DeskImage\DeskImageExtension;
use App\Domain\ValueObjects\DeskImage\DeskImageFileName;
use App\Domain\ValueObjects\DeskImage\DeskImageFilePath;
use App\Domain\ValueObjects\DeskImage\DeskImageId;

class DeskImageEntity
{
    /**
     * @param DeskImageId $id
     * @param DeskImageFileName $fileName
     * @param DeskImageExtension $extension
     * @param DeskImageFilePath $filePath
     */
    public function __construct(
      private readonly DeskImageId $id,
      private readonly DeskImageFileName $fileName,
      private readonly DeskImageExtension $extension,
      private readonly DeskImageFilePath $filePath,
    ) 
    {
    }

    /**
     * @return DeskImageId
     */
    public function getId(): DeskImageId
    {
        return $this->id;
    }

    /**
     * @return DeskImageFileName
     */
    public function getUserId(): DeskImageFileName
    {
        return $this->fileName;
    }

    /**
     * @return DeskExtension
     */
    public function getDescription(): DeskImageExtension
    {
        return $this->extension;
    }

    /**
     * @return DeskImageFilePath
     */
    public function getFilePath(): DeskImageFilePath
    {
        return $this->filePath;
    }
}