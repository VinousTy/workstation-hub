<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\FetchNotificationListRequest;
use App\UseCases\Notification\FetchNotificationList\FetchNotificationListUseCaseInterface;
use App\UseCases\Notification\Inputs\FetchNotificationListInput;
use App\UseCases\Notification\Outputs\FetchNotificationListOutput;
use Illuminate\Http\JsonResponse;

class FetchNotificationListController extends Controller
{
    /**
     * @param  FetchNotificationListUseCaseInterface  $fetchNotificationListUseCaseInterface
     */
    public function __construct(
      private readonly FetchNotificationListUseCaseInterface $fetchNotificationListUseCaseInterface
    ) {
    }

    /**
     * お知らせ一覧を取得
     *
     * @param  FetchNotificationListRequest  $request
     * @return JsonResponse
     */
    public function __invoke(FetchNotificationListRequest $request): JsonResponse
    {
        $notifications = $this->fetchNotificationListUseCaseInterface
          ->execute(new FetchNotificationListInput(
              $request->getPerPage(),
              $request->getCurrentPage(),
          ));

        return response()->json((new FetchNotificationListOutput(
            $notifications['total'],
            $notifications['last_page'],
            $notifications['current_page'],
            $notifications['data'],
            $notifications['links'],
        ))->toArray());
    }
}
