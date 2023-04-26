<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeEmail;

interface UpdateEmailUseCaseInterface
{
  /**
   * メールアドレス更新処理
   *
   * @param  string  $token
   * @return string
   */
  public function execute(string $token): string;
}
