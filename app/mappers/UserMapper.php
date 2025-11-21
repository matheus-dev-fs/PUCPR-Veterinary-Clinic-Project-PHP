<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreateUserDTO;
use app\dtos\LoginUserDTO;
use app\utils\Sanitizer;

class UserMapper
{
    public static function toCreateUserDTO(
        ?string $name,
        ?string $email,
        ?string $emailConfirmation,
        ?string $password,
        ?string $passwordConfirmation,
        ?string $phone
    ): CreateUserDTO {
        return new CreateUserDTO(
            Sanitizer::name($name ?? ''),
            Sanitizer::email($email ?? ''),
            Sanitizer::email($emailConfirmation ?? ''),
            Sanitizer::sanitize($password ?? ''),
            Sanitizer::sanitize($passwordConfirmation ?? ''),
            Sanitizer::sanitize($phone ?? '')
        );
    }

    public static function toLoginUserDTO(
        ?string $email,
        ?string $password
    ): LoginUserDTO {
        return new LoginUserDTO(
            Sanitizer::email($email ?? ''),
            Sanitizer::sanitize($password ?? '')
        );
    }
}
