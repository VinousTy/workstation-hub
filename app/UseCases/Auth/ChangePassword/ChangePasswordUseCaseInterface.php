<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangePassword;

use App\UseCases\Auth\Inputs\ChangePasswordInput;

interface ChangePasswordUseCaseInterface
{
    /**
     * パスワード変更
     *
     * @param  ChangePasswordInput  $input
     * @return void
     */
    public function execute(ChangePasswordInput $input): void;
}
