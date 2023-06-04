<?php

declare(strict_types=1);

namespace App\Exceptions\Base;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * @var string
     */
    private string $errorCode;

    /**
     * @param  string  $errorCode
     * @param  string|null  $message
     * @param  Throwable|null  $previous
     */
    public function __construct(string $errorCode, string $message = null, Throwable $previous = null
    ) {
      $this->errorCode = $errorCode;
      parent::__construct($message, 0, $previous);
    }

    /**
     * エラーコード返却
     *
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Jsonレスポンスを返却
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    abstract protected function getJsonResponse(Request $request): JsonResponse;

    /**
     * JsonでのAPIリクエストでない場合のレスポンス返却
     *
     * @param  Request  $request
     * @return mixed
     */
    abstract protected function getHttpResponse(Request $request);

    /**
     * 例外処理のハンドリングをするためのレスポンスを返却
     *
     * @param  Request  $request
     * @return mixed
     */
    public function getResponse(Request $request)
    {
        return $request->expectsJson()
            ? $this->getJsonResponse($request)
            : $this->getHttpResponse($request);
    }
}
