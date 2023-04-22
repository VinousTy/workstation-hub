<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangePassword;

use App\Repositories\User\Auth\AuthUserRepository;
use App\UseCases\Auth\Inputs\ChangePasswordInput;

class ChangePasswordUseCase implements ChangePasswordUseCaseInterface
{

  /**
   * @param AuthUserRepository $authUserRepository
   */
  public function __construct(private readonly AuthUserRepository $authUserRepository)
  {
  }

  /**
   * {@inheritDoc}
   */
  public function execute(ChangePasswordInput $input): void
  {
      $this->authUserRepository->changedNewPassword($input->getPassword());
  }
}