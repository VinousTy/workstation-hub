<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Models\User;

interface AuthUserRepository
{
    /**
     * ログインユーザーを取得
     *
     * @return User
     */
    public function getUser(): User;

    /**
     * パスワード変更
     *
     * @param string $password
     * @return void
     */
    public function changedNewPassword(string $password): void;
}
