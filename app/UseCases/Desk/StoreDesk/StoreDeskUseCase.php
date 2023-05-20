<?php

declare(strict_types=1);

namespace App\UseCases\Desk\StoreDesk;

use App\Domain\ValueObjects\Category\CategoryName;
use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\User\UserId;
use App\Models\Desk;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Desk\DeskRepository;
use App\Repositories\DeskCategory\DeskCategoryRepository;
use App\Repositories\User\Auth\AuthUserRepository;
use App\UseCases\Desk\Inputs\StoreDeskInput;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreDeskUseCase implements StoreDeskUseCaseInterface
{
    /**
     * @param  AuthUserRepository  $authUserRepository
     * @param  DeskRepository  $deskRepository
     * @param  CategoryReposity  $categoryReposity
     * @param  DeskCategoryReposity  $deskCategoryReposity
     */
    public function __construct(
      private readonly AuthUserRepository $authUserRepository,
      private readonly DeskRepository $deskRepository,
      private readonly CategoryRepository $categoryReposity,
      private readonly DeskCategoryRepository $deskCategoryReposity,
    ) {
    }

    public function execute(StoreDeskInput $input)
    {
        $user = $this->authUserRepository->getUser();

        Log::info('投稿を登録します', [
            'method' => __METHOD__,
            'user_id' => $user->id,
        ]);

        $desk = DB::transaction(function () use ($user, $input) {
            $desk = $this->deskRepository->storeDesk(
              UserId::create($user->id),
              DeskDescription::create($input->getDescription()
            ));
            $category = $this->categoryReposity->firstOrCreate(CategoryName::create($input->getCategoryName()));
            $this->deskCategoryReposity->storeDeskCategory(
              new Desk([
                  'id' => $desk->getId()->getValue(),
                  'user_id' => $desk->getUserId()->getValue(),
                  'description' => $desk->getDescription()->getValue(),
              ]),
              $category->getId()
            );

           return $desk;
        });

        Log::info('投稿の登録が完了しました', [
            'method' => __METHOD__,
            'user_id' => $user->id,
            'desk_id' => $desk->getId()->getValue(),
        ]);
    }
}
