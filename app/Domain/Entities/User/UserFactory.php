<?php

declare(strict_types=1);

namespace App\Domain\Entities\User;

use App\Domain\Entities\User\UserEntity;
use App\Domain\ValueObjects\User\UserEmail;
use App\Domain\ValueObjects\User\UserId;
use App\Domain\ValueObjects\User\UserName;
use App\Domain\ValueObjects\User\UserPassword;
use App\Models\User;

class UserFactory
{
  /**
   * Entity生成
   *
   * @param User $user
   * @return UserEntity
   */
  public static function createUser(User $user): UserEntity
  {
    return new UserEntity(
        UserId::create($user->id),
        UserName::create($user->name),
        UserEmail::create($user->email),
        UserPassword::create($user->password ?? null)
    );
  }
}
