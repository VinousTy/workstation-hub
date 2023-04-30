<?php

declare(strict_types=1);

namespace App\UseCases\Profile\UpdateAuthUserProfile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\UseCases\Profile\Inputs\UpdateAuthUserProfileInput;

interface UpdateAuthUserProfileUseCaseInterface
{
  /**
   * プロフィール情報を更新
   *
   * @param  UpdateAuthUserProfileInput  $input
   * @return ProfileEntity
   */
  public function execute(UpdateAuthUserProfileInput $input): ProfileEntity;
}
