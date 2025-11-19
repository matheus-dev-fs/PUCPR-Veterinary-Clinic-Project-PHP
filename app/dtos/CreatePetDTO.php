<?php 
declare(strict_types=1);

namespace app\dtos;

class CreatePetDTO
{
    private function __construct(
        private readonly string $id_user,
        private readonly string $name,
        private readonly string $type,
        private readonly string $gender
    ) {}

    public function getIdUser(): string
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