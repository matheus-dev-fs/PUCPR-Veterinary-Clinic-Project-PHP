<?php

declare(strict_types=1);

namespace app\dtos;

class DeletePetDTO
{
    public function __construct(
        private readonly int $userId,
        private readonly int $petId
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPetId(): int
    {
        return $this->petId;
    }
}
