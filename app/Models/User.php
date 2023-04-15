<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifiedEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    public function sendPasswordResetNotification($token)
    {
        Log::info('パスワードリセット送信 (ResetPasswordNotification) をqueueに渡します。');
        $this->notify(new ResetPasswordNotification($token));
        Log::info('パスワードリセット送信 (ResetPasswordNotification) をqueueに渡し終えました。');
    }

    /**
     * {@inheritdoc}
     */
    public function sendEmailVerificationNotification()
    {
        Log::info('認証メール送信 (VerificationNotification) をqueueに渡します。');
        $this->notify(new VerifiedEmailNotification());
        Log::info('認証メール送信 (VerificationNotification) をqueueに渡し終えました。');
    }
}
