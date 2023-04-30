<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\Entities\Profile\ProfileFactory;
use App\Domain\ValueObjects\Profile\ProfileId;
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
  public function findOrFail(ProfileId $id): ProfileEntity
  {
      try {
        $profile = Profile::findOrFail($id->getValue());

        return ProfileFactory::createProfile($profile);
      } catch (ModelNotFoundException $e) {
        Log::error([
            'method' => __METHOD__,
            'id' => $id->getValue(),
            'error' => $e,
        ]);

        throw new GetAuthUserProfileException(__('exception.profile.failed'));
      }
  }

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

  /**
   * {@inheritDoc}
   */
  public function updateProfileById(ProfileId $id, array $attribute): ProfileEntity
  {
      Log::info('プロフィール情報を更新します', [
          'method' => __METHOD__,
          'id' => $id->getValue(),
      ]);

      Profile::where('id', $id->getValue())->update($attribute);

      Log::info('プロフィール情報を更新しました', [
          'method' => __METHOD__,
          'id' => $id->getValue(),
      ]);

      return $this->findOrFail($id);
  }
}
