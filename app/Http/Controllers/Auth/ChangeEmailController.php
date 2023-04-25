<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeEmailRequest;
use App\UseCases\Auth\ChangeEmail\ChangeEmailUseCaseInterface;
use App\UseCases\Auth\Inputs\ChangeEmailInput;

class ChangeEmailController extends Controller
{
    /**
     * @param  ChangeEmailUseCaseInterface  $changeEmailUseCaseInterface
     */
    public function __construct(private readonly ChangeEmailUseCaseInterface $changeEmailUseCaseInterface)
    {
    }

    /**
     * メールアドレス変更
     *
     * @param  ChangeEmailRequest  $request
     * @return void
     */
    public function __invoke(ChangeEmailRequest $request)
    {
        $this->changeEmailUseCaseInterface->execute(new ChangeEmailInput($request->getEmail()));

        return response()->json([
            'message' => __('mail.verify_email.success'),
        ]);
    }
}
