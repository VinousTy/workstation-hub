<?php

declare(strict_types=1);

namespace App\Enums\Image;

use MyCLabs\Enum\Enum;

/**
 * @method static ImageType PROFILE()
 * @method static ImageType DESK()
 */
class ImageType extends Enum
{
    // profile画像
    private const PROFILE = 'profile';

    // desk画像
    private const DESK = 'desk';
}
