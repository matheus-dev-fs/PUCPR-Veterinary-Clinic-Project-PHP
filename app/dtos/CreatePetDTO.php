<?php 
declare(strict_types=1);

namespace app\dtos;

class CreatePetDTO
{
    public function __construct(
        private readonly int $userId,
        private readonly string $name,
        private readonly string $type,
        private readonly string $gender
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
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