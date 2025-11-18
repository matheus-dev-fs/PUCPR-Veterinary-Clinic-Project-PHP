<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreateUserDTO;

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

    private function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value));
    }
}
