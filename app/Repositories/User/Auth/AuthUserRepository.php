<?php

declare(strict_types=1);

namespace App\Repositories\User\Auth;

use App\Models\User;

interface AuthUserRepository
{
    public function getUser(): User;
}
