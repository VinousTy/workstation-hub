<?php

declare(strict_types=1);

namespace App\Enums\Category;

use MyCLabs\Enum\Enum;

/**
 * カテゴリ名
 *
 * @method static CategoryName MONITOR()
 * @method static CategoryName COMPUTER()
 * @method static CategoryName KEYBOARD()
 * @method static CategoryName MOUSE()
 * @method static CategoryName SPEAKER()
 * @method static CategoryName TABLE()
 * @method static CategoryName CHAIR()
 * @method static CategoryName OTHER()
 */
class CategoryName extends Enum
{
    // モニター
    private const MONITOR = 'monitor';

    // コンピューター
    private const COMPUTER = 'computer';

    // キーボード
    private const KEYBOARD = 'keyboard';

    // マウス
    private const MOUSE = 'mouse';

    // スピーカー
    private const SPEAKER = 'speaker';

    // テーブル
    private const TABLE = 'table';

    // チェア
    private const CHAIR = 'chair';

    // その他
    private const OTHER = 'other';

    /**
     * 一覧取得
     *
     * @return array
     */
    public static function getCategoryName(): array
    {
        return [
            self::MONITOR,
            self::COMPUTER,
            self::KEYBOARD,
            self::MOUSE,
            self::SPEAKER,
            self::TABLE,
            self::CHAIR,
            self::OTHER,
        ];
    }
}
