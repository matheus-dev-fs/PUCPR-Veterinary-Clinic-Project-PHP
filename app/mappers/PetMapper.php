<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreatePetDTO;

class PetMapper
{
    public function toCreatePetDTO(
        ?int $id_user,
        ?string $name,
        ?string $type,
        ?string $gender
    ): CreatePetDTO {
        return new CreatePetDTO(
            $id_user,
            $this->sanitize($name ?? ''),
            $this->sanitize($type ?? ''),
            $this->sanitize($gender ?? '')
        );
    }

    private function sanitize(string  $value): string
    {
        return htmlspecialchars(trim($value));
    }
}
