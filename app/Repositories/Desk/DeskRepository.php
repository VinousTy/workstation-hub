<?php

declare(strict_types=1);

namespace App\Repositories\Desk;

use App\Domain\Entities\Desk\DeskEntity;
use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\User\UserId;

interface DeskRepository
{
    /**
     * デスクを一覧取得
     * Entityを配列に格納して返却
     *
     * @param  array  $select
     * @param  array  $with
     * @return array
     */
    public function getDeskList(array $select, array $with = []): array;

    /**
     * デスク情報を登録
     *
     * @param  UserId  $userId
     * @param  DeskDescription  $description
     * @return DeskEntity
     */
    public function storeDesk(UserId $userId, DeskDescription $description): DeskEntity;
}
