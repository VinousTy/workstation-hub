<?php 

declare(strict_types=1);

namespace App\Enums\Profile;

use MyCLabs\Enum\Enum;


/**
 * 身長データ
 * 
 * @method static ProfileHeight SHORT_STATURE()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight KILOGRAM_45()
 * @method static ProfileHeight TALL_STATURE()
 */
class ProfileWeight extends Enum
{
    // 軽体重
    private const LIGHT_WEIGHT = 1;

    // 40kg
    private const KILOGRAM_40 = 2;

    // 45kg
    private const KILOGRAM_45 = 3;

    // 50kg
    private const KILOGRAM_50 = 4;

    // 55kg
    private const KILOGRAM_55 = 5;

    // 60kg
    private const KILOGRAM_60 = 6;

    // 65kg
    private const KILOGRAM_65 = 7;

    // 70kg
    private const KILOGRAM_70 = 8;

    // 75kg
    private const KILOGRAM_75 = 9;

    // 80kg
    private const KILOGRAM_80 = 10;

    // 85kg
    private const KILOGRAM_85 = 11;

    // 90kg
    private const KILOGRAM_90 = 12;

    // 95kg
    private const KILOGRAM_95 = 13;

    // 重体重
    private const HEAVY_WEIGHT = 14;
}