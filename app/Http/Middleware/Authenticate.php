<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    private const USER_ROUTE = 'login';

    private const ADMIN_ROUTE = 'admin.login';

    /**
     * {@inheritDoc}
     */
    protected function unauthenticated($request, array $guards): void
    {
        throw new AuthenticationException(
          'Unauthenticated', $guards, $this->redirectToWithGuards($request, $guards)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectToWithGuards(Request $request, array $guards)
    {
        if (! $request->expectsJson()) {
            if (in_array('admin', $guards, true)) {
                return route(self::ADMIN_ROUTE);
            }

            return route(self::USER_ROUTE);
        }

        return null;
    }
}
