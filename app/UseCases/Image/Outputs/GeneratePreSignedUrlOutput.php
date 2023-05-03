<?php

declare(strict_types=1);

namespace App\UseCases\Image\Outputs;

class GeneratePreSignedUrlOutput
{
    /**
     * @param  string  $hashFileName
     * @param  string  $preSignedUrl
     */
    public function __construct(
        private readonly string $hashFileName,
        private readonly string $preSignedUrl,
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
