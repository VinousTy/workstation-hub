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
     * アカウント名変更
     *
     * @param  string  $password
     * @return void
     */
    public function changedNewUserName(string $newName): void;

    /**
     * パスワード変更
     *
     * @param  string  $password
     * @return void
     */
    public function changedNewPassword(string $password): void;

    /**
     * 更新するメールアドレスがユニークであるか確認
     *
     * @param  string  $newEmail
     * @return bool
     */
    public function checkEmailDuplicated(string $newEmail): bool;

    /**
     * メールアドレス更新
     *
     * @param  string  $newEmail
     * @return void
     */
    public function updateEmail(User $user, string $newEmail): void;

    /**
     * 更新したユーザーに紐づくEmailUpdateを削除
     *
     * @param  User  $user
     * @return void
     */
    public function deletedEmailUpdate(User $user): void;
}
