<?php

declare(strict_types=1);

namespace App\Domain\Entities\Profile;

use App\Domain\ValueObjects\Profile\ProfileAccount;
use App\Domain\ValueObjects\Profile\ProfileFilePath;
use App\Domain\ValueObjects\Profile\ProfileHeight;
use App\Domain\ValueObjects\Profile\ProfileId;
use App\Domain\ValueObjects\Profile\ProfileIntroduction;
use App\Domain\ValueObjects\Profile\ProfileUserId;
use App\Domain\ValueObjects\Profile\ProfileWeight;

class ProfileEntity
{
    /**
     * @var ProfileId
     */
    private ProfileId $id;

    /**
     * @var ProfileUserId
     */
    private ProfileUserId $userId;

    /**
     * @var ProfileFilePath|null
     */
    private ?ProfileFilePath $filePath;

    /**
     * @var ProfileHeight|null
     */
    private ?ProfileHeight $height;

    /**
     * @var ProfileWeight|null
     */
    private ?ProfileWeight $weight;

    /**
     * @var ProfileAccount|null
     */
    private ?ProfileAccount $account;

    /**
     * @var ProfileIntroduction|null
     */
    private ?ProfileIntroduction $introduction;

    public function __construct(
        ProfileId $id,
        ProfileUserId $userId,
        ?ProfileFilePath $filePath = null,
        ?ProfileHeight $height = null,
        ?ProfileWeight $weight = null,
        ?ProfileAccount $account = null,
        ?ProfileIntroduction $introduction = null
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
     * @return ProfileId
     */
    public function getId(): ProfileId
    {
      return $this->id;
    }

    /**
     * @return ProfileUserId
     */
    public function getUserId(): ProfileUserId
    {
      return $this->userId;
    }

    /**
     * @return ProfileFilePath|null
     */
    public function getFilePath(): ?ProfileFilePath
    {
      return $this->filePath;
    }

    /**
     * @return ProfileHeight|null
     */
    public function getHeight(): ?ProfileHeight
    {
      return $this->height;
    }

    /**
     * @return ProfileWeight|null
     */
    public function getWeight(): ?ProfileWeight
    {
      return $this->weight;
    }

    /**
     * @return ProfileAccount|null
     */
    public function getAccount(): ?ProfileAccount
    {
      return $this->account;
    }

    /**
     * @return ProfileIntroduction|null
     */
    public function getIntroduction(): ?ProfileIntroduction
    {
      return $this->introduction;
    }
}
