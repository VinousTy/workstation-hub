<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas\User;

use App\OpenApi\Schemas\PropModel;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class UserSchema extends SchemaFactory
{
    /**
     * @param  bool  $nullable
     * @param  string  $objectId
     * @return PropModel
     */
    public static function id(bool $nullable = false, string $objectId = 'id'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('01FEOGNWKGND83')->description('ユーザーID'), $objectId, $nullable);
    }

    /**
     * @param  bool  $nullable
     * @param  string  $objectId
     * @return PropModel
     */
    public static function name(bool $nullable = false, string $objectId = 'name'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('test')->description('ユーザー名'), $objectId, $nullable);
    }

    /**
     * @param  bool  $nullable
     * @param  string  $objectId
     * @return PropModel
     */
    public static function email(bool $nullable = false, string $objectId = 'email'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('test@mail.com')->description('メールアドレス'), $objectId, $nullable);
    }

    /**
     * @param  bool  $nullable
     * @param  string  $objectId
     * @return PropModel
     */
    public static function password(bool $nullable = false, string $objectId = 'n'): PropModel
    {
      return new PropModel(Schema::string($objectId)->example('test')->description('ユーザー名'), $objectId, $nullable);
    }
}
