<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * パスワード認証
     *
     * @param Request $request
     * @return JsonRespone|RedirectResponse
     */
    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {
        $user = User::findOrFail($request->id);

        /* リクエストのhash値とemailのhashが異なっている場合は404を返す */
        if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            abort(404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('auth.verified'),
            ]);
        }

        $user->markEmailAsVerified();

        return redirect('/email/authorization/complete');
    }
}
