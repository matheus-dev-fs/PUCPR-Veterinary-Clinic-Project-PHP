<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreatePetDTO;
use app\utils\Sanitizer;

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
            Sanitizer::sanitize($name ?? ''),
            Sanitizer::sanitize($type ?? ''),
            Sanitizer::sanitize($gender ?? '')
        );
    }
}
