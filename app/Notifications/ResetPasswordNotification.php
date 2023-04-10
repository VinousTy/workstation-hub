<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * {@inheritdoc}
     */
    protected function buildMailMessage($url)
    {
      Log::info('パスワードリセットメールを送信します', [
          'method' => __METHOD__,
          'url' => $url,
      ]);

      return (new MailMessage())
        ->markdown('email.base')
        ->subject(__('mail.reset_password.subject'))
        ->line(__('mail.reset_password.greet'))
        ->action(__('mail.reset_password.action'), $url)
        ->line(__('mail.reset_password.expire', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
        ->line(__('mail.reset_password.notice'));
    }

    /**
     * {@inheritdoc}
     */
    protected function resetUrl($notifiable)
    {
      Log::info('パスワードリセットのURLを生成', [
          'method' => __METHOD__,
          'email' => $notifiable->getEmailForPasswordReset(),
          'notifiable' => $notifiable,
      ]);

      return url(route('password.reset', [
          'token' => $this->token,
          'email' => $notifiable->getEmailForPasswordReset(),
      ], false));
    }
}
