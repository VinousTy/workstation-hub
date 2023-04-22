<?php

declare(strict_types=1);

namespace App\Repositories\Profile\GetAuthUserProfile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\ValueObjects\Profile\ProfileUserId;

interface GetAuthUserProfileRepository
{
  /**
   * プロフィール情報取得
   *
   * @param  string  $userId
   * @return ProfileEntity
   */
  public function findByUserId(ProfileUserId $userId): ProfileEntity;
}
