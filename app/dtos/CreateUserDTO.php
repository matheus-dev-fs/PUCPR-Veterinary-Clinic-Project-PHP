<?php 
declare(strict_types=1);

namespace app\dtos;

class CreateUserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $emailConfirmation,
        private readonly string $password,
        private readonly string $passwordConfirmation,
        private readonly string $phone
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailConfirmation(): string
    {
        return $this->emailConfirmation;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPassword(string $password): CreateUserDTO
    {
        return new CreateUserDTO(
            $this->name,
            $this->email,
            $this->emailConfirmation,
            $password,
            $this->passwordConfirmation,
            $this->phone
        );
    }

    public function setPhone(string $phone): CreateUserDTO
    {
        return new CreateUserDTO(
            $this->name,
            $this->email,
            $this->emailConfirmation,
            $this->password,
            $this->passwordConfirmation,
            $phone
        );
    }
}
?>