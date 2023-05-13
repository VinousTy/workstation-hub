<?php

declare(strict_types=1);

namespace App\Domain\Entities\User;

use App\Domain\ValueObjects\User\UserEmail;
use App\Domain\ValueObjects\User\UserId;
use App\Domain\ValueObjects\User\UserName;
use App\Domain\ValueObjects\User\UserPassword;

class UserEntity
{
    /**
     * @param  UserId  $id
     * @param  UserName  $name
     * @param  UserEmail  $email
     * @param  UserPassword|null  $password
     */
    public function __construct(
      private readonly UserId $id,
      private readonly UserName $name,
      private readonly UserEmail $email,
      private readonly ?UserPassword $password,
    ) {
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
      return $this->id;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
      return $this->name;
    }

    /**
     * @return UserEmail
     */
    public function getEmail(): UserEmail
    {
      return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
      return $this->password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
      return [
          'id' => $this->getId()->getValue(),
          'name' => $this->getName()->getValue(),
          'email' => $this->getEmail()->getValue(),
      ];
    }
}
