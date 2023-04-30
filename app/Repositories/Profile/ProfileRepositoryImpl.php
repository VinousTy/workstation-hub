<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\Entities\Profile\ProfileFactory;
use App\Domain\ValueObjects\Profile\ProfileUserId;
use App\Exceptions\Profile\GetAuthUserProfileException;
use App\Models\Profile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ProfileRepositoryImpl implements ProfileRepository
{
  /**
   * {@inheritDoc}
   */
  public function findByUserId(ProfileUserId $userId): ProfileEntity
  {
      try {
        $profile = Profile::where('user_id', $userId->getValue())->firstOrFail();

        return ProfileFactory::createProfile($profile);
      } catch (ModelNotFoundException $e) {
        Log::error([
            'method' => __METHOD__,
            'error' => $e,
            'user_id' => $userId,
        ]);

        throw new GetAuthUserProfileException(__('exception.profile.failed'));
      }
  }
}
