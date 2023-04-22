<?php

declare(strict_types=1);

namespace App\UseCases\Profile\GetAuthUserProfile;

use App\Domain\Entities\Profile\ProfileEntity;

interface GetAuthUserProfileUseCaseInterface
{
  /**
   * ログインユーザのプロフィール情報を取得
   * 取得したプロフィールのEntityを返却
   *
   * @return ProfileEntity
   */
  public function execute(): ProfileEntity;
}
