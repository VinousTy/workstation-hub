<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\User\Auth\AuthUserRepository;
use Illuminate\Http\JsonResponse;

class GetAuthUserController extends Controller
{
    /**
     * @param  AuthUserRepository  $authUserRepository
     */
    public function __construct(
      private readonly AuthUserRepository $authUserRepository
    ) {
    }

    /**
     * ログインユーザー取得
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $user = $this->authUserRepository->getUser();

        return response()->json([
            'user' => $user,
        ]);
    }
}
