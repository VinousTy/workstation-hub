<?php

declare(strict_types=1);

namespace App\UseCases\Image\Inputs;

class GeneratePreSignedUrlInput
{
    /**
     * @param  string  $id
     * @param  string  $extension
     * @param  string  $type
     */
    public function __construct(
      private readonly string $id,
      private readonly string $extension,
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
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'id' => $this->id,
            'extension' => $this->extension,
            'type' => $this->type,
        ];
    }
}
