<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\Auth\ChangeEmail\UpdateEmailUseCaseInterface;
use Illuminate\Http\RedirectResponse;

class UpdateEmailController extends Controller
{
    /**
     * @param  UpdateEmailUseCaseInterface  $updateEmailUseCaseInterface
     */
    public function __construct(private readonly UpdateEmailUseCaseInterface $updateEmailUseCaseInterface)
    {
    }

    /**
     * メールアドレス更新
     *
     * @param  string  $token
     * @return RedirectResponse
     */
    public function __invoke(string $token): RedirectResponse
    {
        $varifyStatusMessage = $this->updateEmailUseCaseInterface->execute($token);

        return redirect('/settings/account')->with('message', __($varifyStatusMessage));
    }
}
