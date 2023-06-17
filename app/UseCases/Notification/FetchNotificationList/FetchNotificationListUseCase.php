<?php

declare(strict_types=1);

namespace App\UseCases\Notification\FetchNotificationList;

use App\Repositories\Notification\NotificationRepository;
use App\UseCases\Notification\Inputs\FetchNotificationListInput;

class FetchNotificationListUseCase implements FetchNotificationListUseCaseInterface
{
    /**
     * @param  NotificationRepository  $notificationRepository
     */
    public function __construct(private readonly NotificationRepository $notificationRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(FetchNotificationListInput $input): array
    {
       $notificationsPaginator = $this->notificationRepository->getPaginated($input->getPerPage(), $input->getCurrentPage());

       return [
           'total' => $notificationsPaginator->total(),
           'last_page' => $notificationsPaginator->lastPage(),
           'current_page' => $notificationsPaginator->currentPage(),
           'data' => $notificationsPaginator->items(),
           'links' => $notificationsPaginator->toArray()['links'],
       ];
    }
}
