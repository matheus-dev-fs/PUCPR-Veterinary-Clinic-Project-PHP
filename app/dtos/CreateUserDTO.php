<?php 
declare(strict_types=1);

namespace app\dtos;

class CreateUserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
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

    public function getPassword(): string
    {
        return $this->password;
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
            $password,
            $this->phone
        );
    }

    public function setPhone(string $phone): CreateUserDTO
    {
        return new CreateUserDTO(
            $this->name,
            $this->email,
            $this->password,
            $phone
        );
    }
}
?>