<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\AlphaNumSymbol;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetLinkController extends Controller
{
  /**
     * パスワードリセットリンク送信
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email:strict,dns,spoof', 'max:255', new AlphaNumSymbol()],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
                  ? response()->json(['user' => [
                      'email' => $request->email,
                  ]])
                  : response()->json(['message' => __('passwords.error')], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
