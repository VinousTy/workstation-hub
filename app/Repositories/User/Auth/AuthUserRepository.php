<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Domain\ValueObjects\User\UserEmail;
use App\Models\EmailUpdate;
use App\Models\User;
use Illuminate\Support\Carbon;

interface AuthUserRepository
{
    /**
     * ログインユーザーを取得
     *
     * @return User
     */
    public function getUser(): User;

    /**
     * メールアドレス変更
     *
     * @param  User  $user
     * @param  UserEmail  $newEmail
     * @param  string  $token
     * @param  Carbon  $requested_at
     * @return EmailUpdate
     */
    public function changeEmail(User $user, UserEmail $newEmail, string $token, Carbon $requested_at): EmailUpdate;

    /**
     * パスワード変更
     *
     * @param  string  $password
     * @return void
     */
    public function changedNewPassword(string $password): void;
}
