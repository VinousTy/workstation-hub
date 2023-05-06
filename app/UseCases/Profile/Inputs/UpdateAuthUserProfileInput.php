<?php

declare(strict_types=1);

namespace App\UseCases\Profile\Inputs;

class UpdateAuthUserProfileInput
{
    /**
     * @param  string  $id
     * @param  string|null  $filePath
     * @param  int|null  $height
     * @param  int|null  $weight
     * @param  string|null  $account
     * @param  string|null  $introduction
     */
    public function __construct(
      private readonly string $id,
      private readonly ?string $filePath,
      private readonly ?int $height,
      private readonly ?int $weight,
      private readonly ?string $account,
      private readonly ?string $introduction,
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
     * @return array
     */
    public function getParams(): array
    {
        return [
            'file_path' => $this->filePath,
            'height' => $this->height,
            'weight' => $this->weight,
            'account' => $this->account,
            'introduction' => $this->introduction,
        ];
    }
}
