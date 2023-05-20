<?php

declare(strict_types=1);

namespace App\UseCases\Desk\StoreDesk;

use App\UseCases\Desk\Inputs\StoreDeskInput;

interface StoreDeskUseCaseInterface
{
    public function execute(StoreDeskInput $input);
}
