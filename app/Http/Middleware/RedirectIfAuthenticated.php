<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @var string
     */
    private const GUARD_USER = 'web';

    /**
     * @var string
     */
    private const GUARD_ADMIN = 'admin';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard(self::GUARD_USER)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        if (Auth::guard(self::GUARD_ADMIN)->check()) {
          return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        return $next($request);
    }
}
