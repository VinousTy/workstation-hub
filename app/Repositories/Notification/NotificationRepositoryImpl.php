<?php

declare(strict_types=1);

namespace App\Repositories\Notification;

use App\Models\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationRepositoryImpl implements NotificationRepository
{
    /**
     * {@inheritDoc}
     */
    public function getPaginated(string $perPage, string $currentPage): LengthAwarePaginator
    {
        return Notification::orderBy('published_at', 'Desc')
            ->orderBy('updated_at')
            ->paginate(perPage: $perPage, page: $currentPage);
    }
}
