<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthUserRepositoryImpl implements AuthUserRepository
{
  public function getUser(): User
  {
      $user = Auth::guard('web')->user();

      if ($user === null) {
        throw new AuthenticationException();
      }

      return $user;
  }
}
