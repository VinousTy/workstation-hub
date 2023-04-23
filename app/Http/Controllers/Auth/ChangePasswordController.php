<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\UseCases\Auth\ChangePassword\ChangePasswordUseCaseInterface;
use App\UseCases\Auth\Inputs\ChangePasswordInput;
use Illuminate\Http\JsonResponse;

class ChangePasswordController extends Controller
{
    /**
     * @param  ChangePasswordUseCaseInterface  $changePasswordUseCaseInterface
     */
    public function __construct(private readonly ChangePasswordUseCaseInterface $changePasswordUseCaseInterface)
    {
    }

    /**
     * パスワード変更
     *
     * @param  ChangePasswordRequest  $request
     * @return JsonResponse
     */
    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        $this->changePasswordUseCaseInterface
            ->execute(new ChangePasswordInput($request->getPassword()));

        return response()->json([
            'message' => __('auth.password_change'),
        ]);
    }
}
