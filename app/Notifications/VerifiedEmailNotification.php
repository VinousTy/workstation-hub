<?php

declare(strict_types=1);

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerifiedEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * @param [type] $url
     * @return void
     */
    protected function buildMailMessage($url)
    {
        Log::info('認証メールの送信を実施', [
            'method' => __METHOD__,
            'url' => $url,
        ]);

        return (new MailMessage())
          ->markdown('email.user_info.verify-email')
          ->subject(__('mail.verify_email.subject'))
          ->line(__('mail.verify_email.greet'))
          ->line(__('mail.verify_email.notice_apply'))
          ->action(__('mail.verify_email.action'), $url)
          ->line(__('mail.verify_email.expire'))
          ->line(__('mail.verify_email.expire_guide'))
          ->line(__('mail.verify_email.notice'));
    }

    /**
     * @param [type] $notifiable
     * @return void
     */
    protected function verificationUrl($notifiable)
    {
        Log::info('認証URLを生成', [
            'method' => __METHOD__,
            'notifiable' => $notifiable,
            'id' => $notifiable->getKey(),
        ]);

        $expire = Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60));

        return URL::temporarySignedRoute('verification.verify', $expire, [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }
}
