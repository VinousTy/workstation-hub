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
     * @var UserId
     */
    private UserId $id;

    /**
     * @var UserName
     */
    private UserName $name;

    /**
     * @var UserEmail
     */
    private UserEmail $email;

    /**
     * @var UserPassword
     */
    private UserPassword $password;

    /**
     * @param UserId $id
     * @param UserName $name
     * @param UserEmail $email
     * @param UserPassword $password
     */
    public function __construct(
      UserId $id,
      UserName $name,
      UserEmail $email,
      UserPassword $password,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
}

