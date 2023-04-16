<?php

declare(strict_types=1);

namespace App\Enums\Profile;

use MyCLabs\Enum\Enum;

/**
 * 体重データ
 *
 * @method static ProfileWeight LIGHT_WEIGHT()
 * @method static ProfileWeight KILOGRAM_40()
 * @method static ProfileWeight KILOGRAM_45()
 * @method static ProfileWeight KILOGRAM_50()
 * @method static ProfileWeight KILOGRAM_55()
 * @method static ProfileWeight KILOGRAM_60()
 * @method static ProfileWeight KILOGRAM_65()
 * @method static ProfileWeight KILOGRAM_70()
 * @method static ProfileWeight KILOGRAM_75()
 * @method static ProfileWeight KILOGRAM_80()
 * @method static ProfileWeight KILOGRAM_85()
 * @method static ProfileWeight KILOGRAM_90()
 * @method static ProfileWeight KILOGRAM_95()
 * @method static ProfileWeight HEAVY_WEIGHT()
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

    /**
     * 一覧取得
     *
     * @return array
     */
    public static function getWeight(): array
    {
      return [
          self::LIGHT_WEIGHT,
          self::KILOGRAM_40,
          self::KILOGRAM_45,
          self::KILOGRAM_50,
          self::KILOGRAM_55,
          self::KILOGRAM_60,
          self::KILOGRAM_65,
          self::KILOGRAM_70,
          self::KILOGRAM_75,
          self::KILOGRAM_80,
          self::KILOGRAM_85,
          self::KILOGRAM_90,
          self::KILOGRAM_95,
          self::HEAVY_WEIGHT,
      ];
    }
}
