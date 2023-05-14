<?php

declare(strict_types=1);

namespace App\UseCases\Desk\GetDeskList;

use App\Repositories\Desk\DeskRepository;

class GetDeskListUseCase implements GetDeskListUseCaseInterface
{
    /**
     * @param  DeskRepository  $deskRepository
     */
    public function __construct(
      private readonly DeskRepository $deskRepository
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): array
    {
        $desks = $this->deskRepository->getDeskList(
              select: $this->getSelectedColumns(),
              with: [
                  'user.profile',
                  'categories',
                  'deskImages',
              ],
          );

        return $desks;
    }

    /**
     * 取得したいデータ選択
     *
     * @return array
     */
    private function getSelectedColumns(): array
    {
        return [
            'id',
            'user_id',
            'description',
        ];
    }
}
