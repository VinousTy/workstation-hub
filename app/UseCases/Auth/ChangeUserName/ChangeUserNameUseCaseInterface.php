<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeUserName;

use App\UseCases\Auth\Inputs\ChangeUserNameInput;

interface ChangeUserNameUseCaseInterface
{
    /**
     * アカウント名を変更
     *
     * @param  ChangeUserNameInput  $input
     * @return void
     */
    public function execute(ChangeUserNameInput $input): void;
}
