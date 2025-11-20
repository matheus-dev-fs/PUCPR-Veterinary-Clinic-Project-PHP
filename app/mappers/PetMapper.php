<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\CreatePetDTO;
use app\models\Pet;
use app\utils\Sanitizer;

use function PHPSTORM_META\map;

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

    public static function toPetArray(array $data): array
    {
        return \array_map(function (array $item): Pet {
            return new Pet(
                $item['id'],
                $item['id_user'],
                $item['name'],
                $item['type'],
                $item['gender']
            );
        }, $data);
    }
}
