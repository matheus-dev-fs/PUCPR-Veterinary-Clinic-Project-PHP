<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\PetRepository;
use app\core\Database;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\responses\PetResponseResult;

class PetService
{
    private PetRepository $petRepository;

    public function __construct()
    {
        $this->petRepository = new PetRepository(Database::getInstance());
    }

    public function save(CreatePetDTO $createPetDTO): PetResponseResult
    {
        $isAllFieldsValid = $this->isAllFieldsValid($createPetDTO);

        if ($isAllFieldsValid !== true) {
            return new PetResponseResult(null, $isAllFieldsValid);
        }

        $pet = $this->petRepository->save($createPetDTO);
        return new PetResponseResult($pet);
    }

    public function delete(DeletePetDTO $deletePetDTO): PetResponseResult 
    {
        $pet = $this->petRepository->findById($deletePetDTO->getPetId());

        if ($pet === null) {
            return new PetResponseResult(null, ['pet_not_found' => true]);
        }

        if ($pet->getUserId() !== $deletePetDTO->getUserId()) {
            return new PetResponseResult(null, ['unauthorized' => true]);
        }

        $isDeleted = $this->petRepository->delete($deletePetDTO);

        if (!$isDeleted) {
            return new PetResponseResult(null, ['deletion_failed' => true]);
        }

        return new PetResponseResult($pet);
    }

    public function getAllByUserId(int $userId): array
    {
        return $this->petRepository->getAllByUserId($userId);
    } 

    private function isAllFieldsValid(CreatePetDTO $createPetDTO): bool | array
    {
        $errors = [];

        if (empty($createPetDTO->getName())) {
            $errors['name_required'] = true;
        } elseif (strlen($createPetDTO->getName()) < 3) {
            $errors['name_length'] = true;
        }

        if (empty($createPetDTO->getType())) {
            $errors['type_required'] = true;
        } elseif (!in_array($createPetDTO->getType(), ['dog', 'cat', 'other'])) {
            $errors['type_invalid'] = true;
        }

        return empty($errors) ? true : $errors;
    }
}