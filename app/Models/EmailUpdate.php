<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\VerifyUpdateEmailNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class EmailUpdate extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;

    protected $dates = [
        'requested_at',
    ];

    /**
     * 無効なトークン
     */
    public const INVALID_TOKEN = 'email_update.invalid';

    /**
     * 期限切れトークン
     */
    public const EXPIRED_TOKEN = 'email_update.expired';

    /**
     * メール更新
     */
    public const EMAIL_UPDATED = 'email_update.updated';

    /**
     * メール重複
     */
    public const EMAIL_DUPLICATED = 'email_update.duplicated';

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 新規メールアドレスに認証メール送信
     *
     * @param [type] $token
     * @return void
     */
    public function sendEmailResetNotification($token): void
    {
        $this->notify(new VerifyUpdateEmailNotification($token));
    }

    /**
     * 通知が送信される際に宛先のメールアドレスを取得(オーバーライド)
     *
     * @return string
     */
    public function routeNotificationForMail(): string
    {
        return $this->new_email;
    }
}
