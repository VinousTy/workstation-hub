<?php

declare(strict_types=1);

namespace App\UseCases\Desk\StoreDesk;

use App\UseCases\Desk\Inputs\StoreDeskInput;

interface StoreDeskUseCaseInterface
{
    /**
     * デスク情報を登録
     *
     * @param  StoreDeskInput  $input
     * @return void
     */
    public function execute(StoreDeskInput $input): void;
}
