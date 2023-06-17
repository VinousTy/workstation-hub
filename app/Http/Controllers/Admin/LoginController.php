<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @param  AuthManager  $authManager
     */
    public function __construct(private readonly AuthManager $auth)
    {
    }

    /**
     * 管理者ログイン
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->auth->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();

            return response()->json([
                'admin' => $admin,
                'message' => 'ログインしました。',
            ]);
        }

        throw ValidationException::withMessages([
            'name' => __('auth.failed'),
        ]);
    }
}
