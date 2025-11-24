<?php 
declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\Pet;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\dtos\UpdatePetDTO;

interface PetRepositoryInterface
{
    public function save(CreatePetDTO $createPetDTO): ?Pet;
    public function getAllByUserId(int $userId): array;
    public function delete(DeletePetDTO $deletePetDTO): bool;
    public function update(UpdatePetDTO $updatePetDTO): void;
}