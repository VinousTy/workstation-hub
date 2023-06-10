<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * 管理者ログアウト
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
       Auth::guard('admin')->logout();

       $request->session()->invalidate();

       $request->session()->regenerateToken();

       return response()->json([
           'message' => 'ログアウトしました',
       ]);
    }
}
