<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeUserNameRequest;
use App\UseCases\Auth\ChangeUserName\ChangeUserNameUseCaseInterface;
use App\UseCases\Auth\Inputs\ChangeUserNameInput;
use Illuminate\Http\JsonResponse;

class ChangeUserNameController extends Controller
{
    /**
     * @param  ChangeUserNameUseCaseInterface  $changeUserNameUseCaseInterface
     */
    public function __construct(
      private readonly ChangeUserNameUseCaseInterface $changeUserNameUseCaseInterface
    ) {
    }

    /**
     * アカウント名更新
     *
     * @param  ChangeUserNameRequest  $request
     * @return JsonResponse
     */
    public function __invoke(ChangeUserNameRequest $request): JsonResponse
    {
        $this->changeUserNameUseCaseInterface
            ->execute(new ChangeUserNameInput($request->getName()));

        return response()->json([
            'message' => __('auth.name_change'),
        ]);
    }
}
