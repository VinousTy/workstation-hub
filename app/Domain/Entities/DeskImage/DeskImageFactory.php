<?php

declare(strict_types=1);

namespace App\Domain\Entities\DeskImage;

use App\Domain\ValueObjects\DeskImage\DeskImageExtension;
use App\Domain\ValueObjects\DeskImage\DeskImageFileName;
use App\Domain\ValueObjects\DeskImage\DeskImageFilePath;
use App\Domain\ValueObjects\DeskImage\DeskImageId;
use App\Models\DeskImage;

class DeskImageFactory
{
  /**
   * Entity生成
   *
   * @param  DeskImage  $deskImage
   * @return DeskImageEntity
   */
  public static function createDeskImage(DeskImage $deskImage): DeskImageEntity
  {
    return new DeskImageEntity(
        DeskImageId::create($deskImage->id),
        DeskImageFileName::create($deskImage->fileName),
        DeskImageExtension::create($deskImage->extension),
        DeskImageFilePath::create($deskImage->filePath),
    );
  }
}
