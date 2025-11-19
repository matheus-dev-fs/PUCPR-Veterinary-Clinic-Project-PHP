<?php 
declare(strict_types=1);

namespace app\dtos;

class CreatePetDTO
{
    public function __construct(
        private readonly int $id_user,
        private readonly string $name,
        private readonly string $type,
        private readonly string $gender
    ) {}

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGender(): string
    {
        return $this->gender;
    }
}
?>