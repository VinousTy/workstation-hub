<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\AlphaNumSymbol;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Symfony\Component\HttpFoundation\Response;

class NewPasswordController extends Controller
{
    /**
     * 新しいパスワード設定
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255', new AlphaNumSymbol(), PasswordRule::default()],
        ]);

        $status = Password::reset(
          $request->only('email', 'password', 'password_confirmation', 'token'),
          function ($user) use ($request) {
              $user->forceFill([
                  'password' => Hash::make($request->password),
                  'remember_token' => Str::random(60),
              ])->save();
          }
        );

        return $status == Password::PASSWORD_RESET
                  ? response()->json(['message' => __('passwords.reset')])
                  : response()->json(['message' => __('passwords.error')], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
