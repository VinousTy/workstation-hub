<?php

declare(strict_types=1);

namespace App\UseCases\Image\Outputs;

class GeneratePreSignedUrlOutput
{
    /**
     * @param  array  $hashFileName
     * @param  array  $preSignedUrl
     */
    public function __construct(
        private readonly array $hashFileName,
        private readonly array $preSignedUrl,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'hash_file_name' => $this->hashFileName,
            'pre_signed_url' => $this->preSignedUrl,
        ];
    }
}
