<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\ValueObjects\Profile\ProfileId;
use App\Domain\ValueObjects\Profile\ProfileUserId;

interface ProfileRepository
{
  /**
   * idからプロフィール情報取得
   *
   * @param  ProfileId  $id
   * @return ProfileEntity
   */
  public function findOrFail(ProfileId $id): ProfileEntity;

  /**
   * user_idからプロフィール情報取得
   *
   * @param  string  $userId
   * @return ProfileEntity
   */
  public function findByUserId(ProfileUserId $userId): ProfileEntity;

  /**
   * プロフィール情報を更新
   * 更新したプロフィールを返却
   *
   * @param  ProfileId  $id
   * @param  array  $attribute
   * @return ProfileEntity
   */
  public function updateProfileById(ProfileId $id, array $attribute): ProfileEntity;
}
