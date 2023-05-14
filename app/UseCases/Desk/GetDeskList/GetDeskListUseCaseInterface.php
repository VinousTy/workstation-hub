<?php

declare(strict_types=1);

namespace App\UseCases\Desk\GetDeskList;

interface GetDeskListUseCaseInterface
{
    /**
     * 必要なデータを選択して、デスクを一覧取得
     *
     * @return array
     */
    public function execute(): array;
}
