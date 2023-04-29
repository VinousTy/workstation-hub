<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeUserName;

use App\Repositories\User\Auth\AuthUserRepository;
use App\UseCases\Auth\Inputs\ChangeUserNameInput;

class ChangeUserNameUseCase implements ChangeUserNameUseCaseInterface
{
    /**
     * @param  AuthUserRepository  $authUserRepository
     */
    public function __construct(private readonly AuthUserRepository $authUserRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(ChangeUserNameInput $input): void
    {
        $this->authUserRepository->changedNewUserName($input->getName());
    }
}
