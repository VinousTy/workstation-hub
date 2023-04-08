<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /**
   * @param AuthManager $auth
   */
  public function __construct(private readonly AuthManager $auth)
  {
  }

  /**
   * ログイン処理
   * 
   * @param LoginRequest $request
   * @return JsonResponse
   */
  public function __invoke(LoginRequest $request): JsonResponse
  {
    $credentials = $request->only(['email', 'password']);

    if ($this->auth->guard()->attempt($credentials)) {
      $request->session()->regenerate();

      return response()->json(Auth::user());
    }

    throw ValidationException::withMessages([
        'name' => __('auth.failed'),
    ]);
  }
}
