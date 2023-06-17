<?php

declare(strict_types=1);

namespace App\Enums\Common;

use MyCLabs\Enum\Enum;

/**
 * @method static Pagination PAGE10()
 * @method static Pagination PAGE50()
 * @method static Pagination PAGE100()
 */
class Pagination extends Enum
{
    private const PAGE10 = 10;

    private const PAGE50 = 50;

    private const PAGE100 = 100;
}
