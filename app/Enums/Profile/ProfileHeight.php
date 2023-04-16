<?php 

declare(strict_types=1);

namespace App\Enums\Profile;

use MyCLabs\Enum\Enum;


/**
 * 身長データ
 * 
 * @method static ProfileHeight SHORT_STATURE()
 * @method static ProfileHeight CENTIMETERS_150()
 * @method static ProfileHeight CENTIMETERS_155()
 * @method static ProfileHeight CENTIMETERS_160()
 * @method static ProfileHeight CENTIMETERS_165()
 * @method static ProfileHeight CENTIMETERS_170()
 * @method static ProfileHeight CENTIMETERS_175()
 * @method static ProfileHeight CENTIMETERS_180()
 * @method static ProfileHeight CENTIMETERS_185()
 * @method static ProfileHeight CENTIMETERS_190()
 * @method static ProfileHeight TALL_STATURE()
 */
class ProfileHeight extends Enum
{
    // 低身長
    private const SHORT_STATURE = 1;

    // 150㎝
    private const CENTIMETERS_150 = 2;

    // 155㎝
    private const CENTIMETERS_155 = 3;

    // 160㎝
    private const CENTIMETERS_160 = 4;

    // 165㎝
    private const CENTIMETERS_165 = 5;

    // 170㎝
    private const CENTIMETERS_170 = 6;

    // 175㎝
    private const CENTIMETERS_175 = 7;

    // 180㎝
    private const CENTIMETERS_180 = 8;

    // 185㎝
    private const CENTIMETERS_185 = 9;

    // 190㎝
    private const CENTIMETERS_190 = 10;

    // 高身長
    private const TALL_STATURE = 11;
}