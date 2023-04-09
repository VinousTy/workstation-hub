<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
  /**
     * ユーザー作成
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => strstr($data['email'], '@', true),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );

        Log::info('メール認証のメールを送信します。', [
            'id' => $user->id,
            'email' => $user->email,
        ]);

        event(new Registered($user));

        Log::info('メール認証のメールを送信完了しました。');

        Auth::login($user);

        return response()->json([
            'user' => Auth::user(),
            'message' => __('auth.success'),
        ]);
    }
}
