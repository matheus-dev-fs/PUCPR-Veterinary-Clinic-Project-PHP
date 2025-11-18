<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreateUserDTO;
use app\dtos\LoginUserDTO;

class UserMapper
{
    public function toCreateUserDTO(
        ?string $name,
        ?string $email,
        ?string $emailConfirmation,
        ?string $password,
        ?string $passwordConfirmation,
        ?string $phone
    ): CreateUserDTO {
        return new CreateUserDTO(
            $this->sanitize($name ?? ''),
            $this->sanitize($email ?? ''),
            $this->sanitize($emailConfirmation ?? ''),
            $this->sanitize($password ?? ''),
            $this->sanitize($passwordConfirmation ?? ''),
            $this->sanitize($phone ?? '')
        );
    }

    public function toLoginUserDTO(
        ?string $email,
        ?string $password
    ): LoginUserDTO {
        return new LoginUserDTO(
            $this->sanitize($email ?? ''),
            $this->sanitize($password ?? '')
        );
    }

    private function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value));
    }
}
