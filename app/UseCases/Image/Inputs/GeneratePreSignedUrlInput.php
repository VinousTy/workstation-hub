<?php

declare(strict_types=1);

namespace App\UseCases\Image\Inputs;

class GeneratePreSignedUrlInput
{
    /**
     * @param  string  $id
     * @param  array  $extensions
     * @param  string  $type
     */
    public function __construct(
      private readonly string $id,
      private readonly array $extensions,
      private readonly string $type,
    ) {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'id' => $this->id,
            'extension' => $this->extensions,
            'type' => $this->type,
        ];
    }
}
