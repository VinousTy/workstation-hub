<?php

declare(strict_types=1);

namespace App\Domain\Entities\Profile;

use App\Domain\ValueObjects\Profile\ProfileAccount;
use App\Domain\ValueObjects\Profile\ProfileFilePath;
use App\Domain\ValueObjects\Profile\ProfileHeight;
use App\Domain\ValueObjects\Profile\ProfileId;
use App\Domain\ValueObjects\Profile\ProfileIntroduction;
use App\Domain\ValueObjects\Profile\ProfileUserId;
use App\Domain\ValueObjects\Profile\ProfileWeight;
use App\Models\Profile;

class ProfileFactory
{
  /**
   * Entity生成
   *
   * @param  Profile  $profile
   * @return ProfileEntity
   */
  public static function createProfile(Profile $profile): ProfileEntity
  {
    return new ProfileEntity(
        ProfileId::create($profile->id),
        ProfileUserId::create($profile->user_id),
        ProfileFilePath::create($profile->file_path),
        ProfileHeight::create($profile->height),
        ProfileWeight::create($profile->weight),
        ProfileAccount::create($profile->account),
        ProfileIntroduction::create($profile->introduction)
    );
  }
}
