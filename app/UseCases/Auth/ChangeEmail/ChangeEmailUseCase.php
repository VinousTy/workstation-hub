<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeEmail;

use App\Domain\ValueObjects\User\UserEmail;
use App\Repositories\User\Auth\AuthUserRepository;
use App\UseCases\Auth\Inputs\ChangeEmailInput;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChangeEmailUseCase implements ChangeEmailUseCaseInterface
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
    public function execute(ChangeEmailInput $input): void
    {
        $user = $this->authUserRepository->getUser();
        $token = $this->generateToken();

        $emailUpdate = $this->authUserRepository->changeEmail(
            $user,
            UserEmail::create($input->getEmail()),
            $token,
            Date::now(),
        );

        Log::info($input->getEmail().'宛にアドレス変更用の認証メールを送信します', [
            'user_id' => $user->id,
            'new_email' => $input->getEmail(),
            'old_email' => $user->email,
        ]);

        $emailUpdate->sendEmailResetNotification($token);

        Log::info($input->getEmail().'宛にアドレス変更用の認証メールを送信完了しました', [
            'user_id' => $user->id,
            'new_email' => $input->getEmail(),
            'old_email' => $user->email,
        ]);
    }

    /**
     * トークン生成
     *
     * @return string
     */
    private function generateToken(): string
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }
}
