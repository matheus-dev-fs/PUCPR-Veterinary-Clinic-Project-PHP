<?php
declare(strict_types=1);

namespace app\services;

use app\core\AuthHelper;
use app\repositories\PetRepository;
use app\core\Database;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\dtos\UpdatePetDTO;
use app\responses\PetResponseResult;

class PetService
{
    private const MIN_NAME_LENGTH = 3;
    private const VALID_TYPES = ['dog', 'cat', 'other'];

    private PetRepository $petRepository;

    public function __construct()
    {
        $this->petRepository = new PetRepository(Database::getInstance());
    }

    public function save(CreatePetDTO $createPetDTO): PetResponseResult
    {
        $errors = $this->validatePetData(
            $createPetDTO->getName(),
            $createPetDTO->getType()
        );

        if (!empty($errors)) {
            return new PetResponseResult(null, $errors);
        }

        $pet = $this->petRepository->save($createPetDTO);
        return new PetResponseResult($pet);
    }

    public function update(UpdatePetDTO $updatePetDTO): PetResponseResult
    {   
        if (empty($updatePetDTO->getId())) {
            return new PetResponseResult(null, ['pet_id_required' => true]);
        }

        $errors = $this->validatePetData(
            $updatePetDTO->getName(),
            $updatePetDTO->getType()
        );

        if (!empty($errors)) {
            return new PetResponseResult(null, $errors);
        }

        $authorizationResult = $this->checkPetAuthorization($updatePetDTO->getId());
        if (!$authorizationResult->isSuccess()) {
            return $authorizationResult;
        }

        $this->petRepository->update($updatePetDTO);
        
        return $this->getPetById($updatePetDTO->getId());
    }

    public function delete(DeletePetDTO $deletePetDTO): PetResponseResult 
    {
        if (empty($deletePetDTO->getPetId())) {
            return new PetResponseResult(null, ['pet_id_required' => true]);
        }

        $authorizationResult = $this->checkPetAuthorization($deletePetDTO->getPetId());
        if (!$authorizationResult->isSuccess()) {
            return $authorizationResult;
        }

        $isDeleted = $this->petRepository->delete($deletePetDTO);

        if (!$isDeleted) {
            return new PetResponseResult(null, ['deletion_failed' => true]);
        }

        return $authorizationResult;
    }

    public function getPetById(int $petId): PetResponseResult
    {
        return $this->checkPetAuthorization($petId);
    }

    public function getAllByUserId(int $userId): array
    {
        return $this->petRepository->getAllByUserId($userId);
    }

    private function validatePetData(string $name, string $type): array
    {
        $errors = [];

        $errors = array_merge($errors, $this->validateName($name));
        $errors = array_merge($errors, $this->validateType($type));

        return $errors;
    }

    private function validateName(string $name): array
    {
        $errors = [];

        if (empty($name)) {
            $errors['name_required'] = true;
        } elseif (strlen($name) < self::MIN_NAME_LENGTH) {
            $errors['name_length'] = true;
        }

        return $errors;
    }

    private function validateType(string $type): array
    {
        $errors = [];

        if (empty($type)) {
            $errors['type_required'] = true;
        } elseif (!in_array($type, self::VALID_TYPES)) {
            $errors['type_invalid'] = true;
        }

        return $errors;
    }

    private function checkPetAuthorization(int $petId): PetResponseResult
    {
        $pet = $this->petRepository->findById($petId);

        if ($pet === null) {
            return new PetResponseResult(null, ['pet_not_found' => true]);
        }

        if ($pet->getUserId() !== AuthHelper::getUserLoggedId()) {
            return new PetResponseResult(null, ['unauthorized' => true]);
        }

        return new PetResponseResult($pet);
    }
}