<?php

declare(strict_types=1);

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use App\UseCases\Desk\GetDeskList\GetDeskListUseCaseInterface;
use App\UseCases\Desk\Output\GetDeskListOutput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetDeskListController extends Controller
{
    /**
     * @param  GetDeskListUseCaseInterface  $getDeskListUseCaseInterface
     */
    public function __construct(
      private readonly GetDeskListUseCaseInterface $getDeskListUseCaseInterface
    ) {
    }

    /**
     * 投稿デスク一覧を取得
     *
     * @return J sonResponse
     */
    public function __invoke(): JsonResponse
    {
        $entities = $this->getDeskListUseCaseInterface->execute();

        return response()->json((new GetDeskListOutput($entities))->toArray(), Response::HTTP_OK);
    }
}
