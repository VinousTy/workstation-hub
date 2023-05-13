<?php

declare(strict_types=1);

namespace App\Domain\Entities\Desk;

use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\Desk\DeskId;
use App\Domain\ValueObjects\Desk\DeskUserId;

class DeskEntity
{
    /**
     * @param  DeskId  $id
     * @param  DeskUserId  $userId
     * @param  DeskDescription  $description
     */
    public function __construct(
      private readonly DeskId $id,
      private readonly DeskUserId $userId,
      private readonly DeskDescription $description,
    ) {
    }

    /**
     * @return DeskId
     */
    public function getId(): DeskId
    {
        return $this->id;
    }

    /**
     * @return DeskUserId
     */
    public function getUserId(): DeskUserId
    {
        return $this->userId;
    }

    /**
     * @return DeskDescription
     */
    public function getDescription(): DeskDescription
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'user_id' => $this->getUserId()->getValue(),
            'description' => $this->getDescription()->getValue(),
        ];
    }
}
