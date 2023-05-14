<?php

declare(strict_types=1);

namespace App\UseCases\Profile\Outputs;

use Illuminate\Support\Facades\Storage;

class GetAuthUserProfileOutput
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $userId;

    /**
     * @var string|null
     */
    private ?string $filePath;

    /**
     * @var int|null
     */
    private ?int $height;

    /**
     * @var int|null
     */
    private ?int $weight;

    /**
     * @var string|null
     */
    private ?string $account;

    /**
     * @var string|null
     */
    private ?string $introduction;

    /**
     * @param  string  $id
     * @param  string  $userId
     * @param  string|null  $filePath
     * @param  int|null  $height
     * @param  int|null  $weight
     * @param  string|null  $account
     * @param  string|null  $introduction
     */
    public function __construct(
        string $id,
        string $userId,
        ?string $filePath = null,
        ?int $height = null,
        ?int $weight = null,
        ?string $account = null,
        ?string $introduction = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->filePath = $filePath;
        $this->height = $height;
        $this->weight = $weight;
        $this->account = $account;
        $this->introduction = $introduction;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
      if (isset($this->filePath)) {
        $s3Path = Storage::disk('s3_private')->url(config('filesystems.disks.s3_private.bucket').'/');
      }

      return [
          'id' => $this->id,
          'user_id' => $this->userId,
          'file_path' => $this->filePath ? $s3Path.$this->filePath : $this->filePath,
          'height' => $this->height,
          'weight' => $this->weight,
          'account' => $this->account,
          'introduction' => $this->introduction,
      ];
    }
}
