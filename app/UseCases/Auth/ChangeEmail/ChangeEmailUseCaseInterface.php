<?php

declare(strict_types=1);

namespace App\UseCases\Auth\ChangeEmail;

use App\UseCases\Auth\Inputs\ChangeEmailInput;

interface ChangeEmailUseCaseInterface
{
  /**
   * メールアドレス変更
   *
   * @param  ChangeEmailInput  $input
   * @return void
   */
  public function execute(ChangeEmailInput $input): void;
}
