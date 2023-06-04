<?php

declare(strict_types=1);

namespace App\Exceptions\Image;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UploadS3Exception extends Exception
{
    /**
     * @param  string  $message
     */
    public function __construct(string $message)
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
    public function render()
    {
      return response([
          'message' => $this->message,
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
