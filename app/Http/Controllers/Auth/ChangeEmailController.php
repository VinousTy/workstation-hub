<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeEmailRequest;
use App\OpenApi\RequestBodies\User\ChangeEmailRequestBody;
use App\UseCases\Auth\ChangeEmail\ChangeEmailUseCaseInterface;
use App\UseCases\Auth\Inputs\ChangeEmailInput;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
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
    #[OpenApi\Operation(tags: ['user'])]
    #[OpenApi\RequestBody(factory: ChangeEmailRequestBody::class)]
    public function __invoke(ChangeEmailRequest $request)
    {
        $this->changeEmailUseCaseInterface->execute(new ChangeEmailInput($request->getEmail()));

        return response()->json([
            'message' => __('mail.verify_email.success'),
        ]);
    }
}
