<?php

declare(strict_types=1);

namespace App\Domain\Entities\Desk;

use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\Desk\DeskId;
use App\Domain\ValueObjects\Desk\DeskUserId;
use App\Models\Desk;

class DeskFactory
{
  /**
   * Entity生成
   *
   * @param  Desk  $desk
   * @return DeskEntity
   */
  public static function createProfile(Desk $desk): DeskEntity
  {
    return new DeskEntity(
        DeskId::create($desk->id),
        DeskUserId::create($desk->user_id),
        DeskDescription::create($desk->file_path),
    );
  }
}
