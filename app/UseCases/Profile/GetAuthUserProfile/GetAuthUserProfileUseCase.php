<?php

declare(strict_types=1);

namespace App\UseCases\Profile\GetAuthUserProfile;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\ValueObjects\Profile\ProfileUserId;
use App\Repositories\Profile\GetAuthUserProfile\GetAuthUserProfileRepository;
use App\Repositories\User\Auth\AuthUserRepository;

class GetAuthUserProfileUseCase implements GetAuthUserProfileUseCaseInterface
{
  /**
   * @param  AuthUserRepository  $authUserRepository
   */
  public function __construct(
    private readonly AuthUserRepository $authUserRepository,
    private readonly GetAuthUserProfileRepository $getAuthUserProfileRepository,
  ) {
  }

  /**
   * {@inheritDoc}
   */
  public function execute(): ProfileEntity
  {
      $user = $this->authUserRepository->getUser();

      return $this->getAuthUserProfileRepository->findByUserId(
        ProfileUserId::create($user->id)
      );
  }
}
