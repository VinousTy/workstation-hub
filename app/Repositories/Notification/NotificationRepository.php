<?php

declare(strict_types=1);

namespace App\Repositories\Notification;

use Illuminate\Pagination\LengthAwarePaginator;

interface NotificationRepository
{
    /**
     * 公開日時でソートしてページネーションで一覧取得
     *
     * @param  string  $perPage
     * @param  string  $currentPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(string $perPage, string $currentPage): LengthAwarePaginator;
}
