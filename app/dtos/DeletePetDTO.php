<?php

declare(strict_types=1);

namespace app\dtos;

class DeletePetDTO
{
    public function __construct(
        private readonly int $user_id,
        private readonly int $pet_id
    ) {}

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getPetId(): int
    {
        return $this->pet_id;
    }
}
