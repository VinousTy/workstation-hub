<?php

declare(strict_types=1);

namespace App\Repositories\Desk;

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
}
