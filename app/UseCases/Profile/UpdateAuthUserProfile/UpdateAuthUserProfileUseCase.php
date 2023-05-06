<?php

declare(strict_types=1);

namespace App\UseCases\Profile\UpdateAuthUserProfile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\ValueObjects\Profile\ProfileId;
use App\Repositories\Profile\ProfileRepository;
use App\UseCases\Profile\Inputs\UpdateAuthUserProfileInput;

class UpdateAuthUserProfileUseCase implements UpdateAuthUserProfileUseCaseInterface
{
    /**
     * @param  ProfileRepository  $profileRepository
     */
    public function __construct(
      private readonly ProfileRepository $profileRepository
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(UpdateAuthUserProfileInput $input): ProfileEntity
    {
        return $this->profileRepository->updateProfileById(
            ProfileId::create($input->getId()),
            $input->getParams(),
        );
    }
}
