<?php
declare(strict_types=1);

namespace app\services;

use app\core\AuthHelper;
use app\repositories\PetRepository;
use app\repositories\AppointmentRepository;
use app\core\Database;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\dtos\UpdatePetDTO;
use app\repositories\interfaces\AppointmentRepositoryInterface;
use app\repositories\interfaces\PetRepositoryInterface;
use app\responses\PetResponseResult;

class PetService
{
    private const MIN_NAME_LENGTH = 3;
    private const VALID_TYPES = ['dog', 'cat', 'other'];

    private PetRepositoryInterface $petRepository;
    private AppointmentRepositoryInterface $appointmentRepository;

    public function __construct()
    {
        $this->petRepository = new PetRepository(Database::getInstance());
        $this->appointmentRepository = new AppointmentRepository(Database::getInstance());
    }

    public function save(CreatePetDTO $createPetDTO): PetResponseResult
    {
        try {
            $errors = $this->validatePetData(
                $createPetDTO->getName(),
                $createPetDTO->getType()
            );

            if (!empty($errors)) {
                return new PetResponseResult(null, $errors);
            }

            $pet = $this->petRepository->save($createPetDTO);
            return new PetResponseResult($pet);
        } catch (\Exception $e) {
            return new PetResponseResult(null, ['db_error' => 'Error saving pet: ' . $e->getMessage()]);
        }
    }

    public function update(UpdatePetDTO $updatePetDTO): PetResponseResult
    {   
        try {
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
        } catch (\Exception $e) {
            return new PetResponseResult(null, ['db_error' => 'Error updating pet: ' . $e->getMessage()]);
        }
    }

    public function delete(DeletePetDTO $deletePetDTO): PetResponseResult 
    {
        try {
            if (empty($deletePetDTO->getPetId())) {
                return new PetResponseResult(null, ['pet_id_required' => true]);
            }

            $authorizationResult = $this->checkPetAuthorization($deletePetDTO->getPetId());
            if (!$authorizationResult->isSuccess()) {
                return $authorizationResult;
            }

            if ($this->checkIfPetHasAppointments($deletePetDTO->getPetId())) {
                return new PetResponseResult(null, ['pet_has_appointments' => true]);
            }

            $isDeleted = $this->petRepository->delete($deletePetDTO);

            if (!$isDeleted) {
                return new PetResponseResult(null, ['deletion_failed' => true]);
            }

            return $authorizationResult;
        } catch (\Exception $e) {
            return new PetResponseResult(null, ['db_error' => 'Error deleting pet: ' . $e->getMessage()]);
        }
    }

    public function getPetById(int $petId): PetResponseResult
    {
        try {
            return $this->checkPetAuthorization($petId);
        } catch (\Exception $e) {
            return new PetResponseResult(null, ['db_error' => 'Error retrieving pet: ' . $e->getMessage()]);
        }
    }

    public function getAllByUserId(int $userId): array
    {
        try {
            return $this->petRepository->getAllByUserId($userId);
        } catch (\Exception $e) {
            return [];
        }
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
        try {
            $pet = $this->petRepository->findById($petId);

            if ($pet === null) {
                return new PetResponseResult(null, ['pet_not_found' => true]);
            }

            if ($pet->getUserId() !== AuthHelper::getUserLoggedId()) {
                return new PetResponseResult(null, ['unauthorized' => true]);
            }

            return new PetResponseResult($pet);
        } catch (\Exception $e) {
            return new PetResponseResult(null, ['db_error' => 'Error checking pet authorization: ' . $e->getMessage()]);
        }
    }

    private function checkIfPetHasAppointments(int $petId): bool
    {
        $appointment = $this->appointmentRepository->findByPetId($petId);
        return $appointment !== null;
    }
}