<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Domain\ValueObjects\User\UserEmail;
use App\Models\EmailUpdate;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserRepositoryImpl implements AuthUserRepository
{
  /**
   * {@inheritDoc}
   */
  public function getUser(): User
  {
      $user = Auth::guard('web')->user();

      if ($user === null) {
        throw new AuthenticationException();
      }

      return $user;
  }

  /**
   * {@inheritDoc}
   */
  public function changeEmail(User $user, UserEmail $newEmail, string $token, Carbon $requested_at): EmailUpdate
  {
      return $user->email_update()->updateOrCreate(
        [
            'user_id' => $user->id,
        ],
        [
            'new_email' => $newEmail->getValue(),
            'token' => $token,
            'requested_at' => $requested_at,
        ],
      );
  }

  /**
   * {@inheritDoc}
   */
  public function changedNewPassword(string $password): void
  {
      $user = $this->getUser();
      $user->password = Hash::make($password);
  }
}
