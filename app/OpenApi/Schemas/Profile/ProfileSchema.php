<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\Profile;

use App\Enums\Profile\ProfileHeight;
use App\Enums\Profile\ProfileWeight;
use App\OpenApi\Schemas\PropModel;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ProfileSchema
{
    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function id(bool $nullable = false, string $objectId = 'id'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('01FEOGNWKGND83')->description('プロフィールID'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function userId(bool $nullable = false, string $objectId = 'user_id'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('01JGOHVNEUEF35')->description('プロフィールID'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function filePath(bool $nullable = false, string $objectId = 'file_path'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('http://s3aijfeijfad')->description('アバター画像'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function height(bool $nullable = false, string $objectId = 'height'): PropModel
    {
      return new PropModel(Schema::integer($objectId)->example(ProfileHeight::CENTIMETERS_150()->getValue())->description('身長'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function weight(bool $nullable = false, string $objectId = 'weight'): PropModel
    {
      return new PropModel(Schema::integer($objectId)->example(ProfileWeight::KILOGRAM_40()->getValue())->description('体重'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function account(bool $nullable = false, string $objectId = 'account'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('https://kuphal.com/in-nostrum-aut-non-hic-quam.html')->description('体重'), $objectId, $nullable);
    }

    /**
     * @param boolean $nullable
     * @param string $objectId
     * @return PropModel
     */
    public static function introduction(bool $nullable = false, string $objectId = 'introduction'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('hogehoge-test')->description('自己紹介'), $objectId, $nullable);
    }
}
