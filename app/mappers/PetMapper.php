<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\dtos\UpdatePetDTO;
use app\models\Pet;
use app\utils\Sanitizer;

class PetMapper
{
    public function toCreatePetDTO(
        ?int $userId,
        ?string $name,
        ?string $type,
        ?string $gender
    ): CreatePetDTO {
        return new CreatePetDTO(
            $userId,
            Sanitizer::sanitize($name ?? ''),
            Sanitizer::sanitize($type ?? ''),
            Sanitizer::sanitize($gender ?? '')
        );
    }

    public function toDeletePetDTO(?string $userId, ?string $petId): DeletePetDTO
    {
        return new DeletePetDTO(
            (int) Sanitizer::sanitize($userId ?? ''),
            (int) Sanitizer::sanitize($petId ?? '')
        );
    }

    public function toUpdatePetDTO(
        ?string $id,
        ?string $name,
        ?string $type,
        ?string $gender
    ): UpdatePetDTO {
        return new UpdatePetDTO(
            (int) Sanitizer::sanitize($id ?? ''),
            Sanitizer::sanitize($name ?? ''),
            Sanitizer::sanitize($type ?? ''),
            Sanitizer::sanitize($gender ?? '')
        );
    }

    public static function toPetArray(array $data): array
    {
        return \array_map(function (array $item): Pet {
            return new Pet(
                $item['id'],
                $item['user_id'],
                $item['name'],
                $item['type'],
                $item['gender']
            );
        }, $data);
    }

    public static function responseToPet(array $data): Pet {
        return new Pet(
            $data['id'],
            $data['user_id'],
            $data['name'],
            $data['type'],
            $data['gender']
        );
    }
}
