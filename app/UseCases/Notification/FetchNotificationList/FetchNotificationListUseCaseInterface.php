<?php

declare(strict_types=1);

namespace App\UseCases\Notification\FetchNotificationList;

use App\UseCases\Notification\Inputs\FetchNotificationListInput;

interface FetchNotificationListUseCaseInterface
{
    /**
     * お知らせ一覧をページネーションで取得
     *
     * @param  FetchNotificationListInput  $input
     * @return array
     */
    public function execute(FetchNotificationListInput $input): array;
}
