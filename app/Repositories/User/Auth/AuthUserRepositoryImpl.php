<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
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
  public function changedNewPassword(string $password): void
  {
      $user = $this->getUser();
      $user->password = Hash::make($password);
  }
}
