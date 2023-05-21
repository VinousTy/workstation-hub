<?php

declare(strict_types=1);

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desk\StoreDeskRequest;
use App\UseCases\Desk\Inputs\StoreDeskInput;
use App\UseCases\Desk\StoreDesk\StoreDeskUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreDeskController extends Controller
{
    /**
     * @param  StoreDeskUseCaseInterface  $storeDeskUseCaseInterface
     */
    public function __construct(private readonly StoreDeskUseCaseInterface $storeDeskUseCaseInterface)
    {

    }

    /**
     * デスク情報を登録
     *
     * @param  StoreDeskRequest  $request
     * @return JsonResponse
     */
    public function __invoke(StoreDeskRequest $request): JsonResponse
    {
        $this->storeDeskUseCaseInterface->execute(new StoreDeskInput(
          $request->getDescription(),
          $request->getCategoryNames(),
        ));

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
