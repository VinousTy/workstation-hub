<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeEmail;

use App\Models\EmailUpdate;
use App\Repositories\User\Auth\AuthUserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateEmailUseCase implements UpdateEmailUseCaseInterface
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
    public function execute(string $token): string
    {
        $user = $this->authUserRepository->getUser();

        $emailUpdate = $this->validEmailUpdate($user->email_update, $token);

        if (! $emailUpdate instanceof EmailUpdate) {
          return $emailUpdate;
        }

        Log::info('メールアドレスの更新処理を開始します', [
            'method' => __METHOD__,
            'user_id' => $user->id,
            'old_email' => $user->email,
            'new_email' => $emailUpdate->new_email,
        ]);

        $this->authUserRepository->updateEmail($user, $emailUpdate->new_email);

        Log::info('メールアドレスの更新処理が完了しました', [
            'method' => __METHOD__,
            'user_id' => $user->id,
            'old_email' => $user->email,
            'new_email' => $emailUpdate->new_email,
        ]);

        $this->authUserRepository->deletedEmailUpdate($user);

        return EmailUpdate::EMAIL_UPDATED;
    }

    /**
     * 更新するアドレスの有効性チェック
     *
     * @param  EmailUpdate  $emailUpdate
     * @param  string  $token
     * @return string|EmailUpdate
     */
    private function validEmailUpdate(EmailUpdate $emailUpdate, string $token): string|EmailUpdate
    {
        // 無効なトークン
        if (! $emailUpdate || $emailUpdate->token !== $token) {
            return EmailUpdate::INVALID_TOKEN;
        }

        // 更新するメールアドレスのユニークチェック
        if ($this->authUserRepository->checkEmailDuplicated($emailUpdate->new_email)) {
            return EmailUpdate::EMAIL_DUPLICATED;
        }

        // 有効期限チェック
        if ($this->isExpired($emailUpdate->requested_at)) {
          return EmailUpdate::EXPIRED_TOKEN;
        }

        return $emailUpdate;
    }

    /**
     * requested_atの60分後の日時より過去の日時であればtrueを、それ以外の場合はfalseを返却
     *
     * @param  CarbonImmutable  $requested_at
     * @return bool
     */
    private function isExpired(Carbon $requested_at): bool
    {
        return $requested_at->addMinutes(config('auth.mail.update.expire'))->isPast();
    }
}
