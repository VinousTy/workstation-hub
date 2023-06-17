<?php

declare(strict_types=1);

namespace App\UseCases\Notification\Inputs;

class FetchNotificationListInput
{
    /**
     * @param  string|null  $perPage
     * @param  string|null  $currentPage
     */
    public function __construct(
      private readonly ?string $perPage,
      private readonly ?string $currentPage,
    ) {
    }

    /**
     * @return string|null
     */
    public function getPerPage(): string|null
    {
        return $this->perPage;
    }

    /**
     * @return string|null
     */
    public function getCurrentPage(): string|null
    {
        return $this->currentPage;
    }
}
