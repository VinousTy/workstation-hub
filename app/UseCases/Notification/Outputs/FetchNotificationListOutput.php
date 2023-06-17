<?php

declare(strict_types=1);

namespace App\UseCases\Notification\Outputs;

class FetchNotificationListOutput
{
    /**
     * @param  int  $total
     * @param  int  $lastPage
     * @param  int  $currentPage
     * @param  array  $data
     * @param  array  $links
     */
    public function __construct(
      private readonly int $total,
      private readonly int $lastPage,
      private readonly int $currentPage,
      private readonly array $data,
      private readonly array $links,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'last_page' => $this->lastPage,
            'current_page' => $this->currentPage,
            'data' => $this->data,
            'links' => $this->links,
        ];
    }
}
