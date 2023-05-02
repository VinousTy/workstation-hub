<?php

declare(strict_types=1);

namespace App\Exceptions\Image;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class GenerateUrlException extends Exception
{
    /**
     * @var string
     */
    private string $message;

    /**
     * @param [type] $message
     * @return void
     */
    public function __callStatic($message)
    {
        $this->message = $message;
    }

    /**
     * Report the exception.
     *
     * @return bool
     */
    public function report(): bool
    {
        return false;
    }

    /**
     * Render the exception on HTTP response.
     *
     * @return Response
     */
    public function render(): Response
    {
      return response([
          'message' => $this->message,
      ], Response::HTTP_NOT_FOUND);
    }
}
