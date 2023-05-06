<?php

declare(strict_types=1);

namespace App\UseCases\Image\Inputs;

class UploadImageInput
{
    /**
     * @param  string  $id
     * @param  string  $extension
     * @param  string  $hashFileName
     */
    public function __construct(
      private readonly string $id,
      private readonly string $extension,
      private readonly string $hashFileName,
    ) {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getHashFileName(): string
    {
        return $this->hashFileName;
    }
}
