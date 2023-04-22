<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class PropModel
{
  /**
   * @param  Schema  $schema
   * @param  string  $objectId
   * @param  bool  $nullable
   * @param  bool  $isArray
   */
  public function __construct(
    private readonly Schema $schema,
    private readonly string $objectId,
    private readonly bool $nullable,
    private readonly bool $isArray = false,
  ) {
  }

  /**
   * @return Schema
   */
  public function getSchema(): Schema
  {
    $propertySchema = $this->nullable ? $this->schema->nullable() : $this->schema;

    return $this->isArray ? Schema::array($this->objectId)->items($propertySchema) : $propertySchema;
  }

  /**
   * @return string
   */
  public function getObjectId(): string
  {
    return $this->objectId;
  }

  /**
   * @return bool
   */
  public function isNullable(): bool
  {
    return $this->nullable;
  }
}
