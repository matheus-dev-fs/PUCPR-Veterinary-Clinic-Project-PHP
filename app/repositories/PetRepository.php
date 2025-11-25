<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\dtos\UpdatePetDTO;
use app\models\Pet;
use app\mappers\PetMapper;
use app\repositories\interfaces\PetRepositoryInterface;

class PetRepository extends Repository implements PetRepositoryInterface
{
    public function findById(int $id): ?Pet
    {
        try {
            $sql = "SELECT id, user_id, `name`, `type`, gender FROM Pet WHERE id = :id AND active = TRUE";
            $params = [':id' => $id];

            $result = $this->database->fetch($sql, $params);

            return $result === false ? null : PetMapper::responseToPet($result);
        } catch (\Exception $e) {
            throw new \Exception('Error finding pet by ID: ' . $e->getMessage());
        }
    }

    public function save(CreatePetDTO $createPetDTO): ?Pet
    {
        try {
            $this->database->beginTransaction();

            $sql = "INSERT INTO Pet (user_id, name, type, gender) VALUES (:user_id, :name, :type, :gender)";
            $params = [
                ':user_id' => $createPetDTO->getUserId(),
                ':name'    => $createPetDTO->getName(),
                ':type'    => $createPetDTO->getType(),
                ':gender'  => $createPetDTO->getGender()
            ];

            $rows = $this->database->execute($sql, $params);

            if ($rows === 0) {
                return null;
            }

            $lastInsertId = (int)$this->database->lastInsertId();

            $this->database->commit();

            return new Pet(
                $lastInsertId,
                $createPetDTO->getUserId(),
                $createPetDTO->getName(),
                $createPetDTO->getType(),
                $createPetDTO->getGender()
            );
        } catch (\Exception $e) {
            throw new \Exception('Error saving pet: ' . $e->getMessage());
        }   
    }

    public function getAllByUserId(int $userId): array
    {
        try {
            $sql = "SELECT id, user_id, `name`, `type`, gender FROM Pet WHERE user_id = :user_id AND active = TRUE";
            $params = [':user_id' => $userId];

            $results = $this->database->fetchAll($sql, $params);
            return PetMapper::toPetArray($results);
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving pets: ' . $e->getMessage());
        }
    }

    public function delete(DeletePetDTO $deletePetDTO): bool
    {
        try {
            $this->database->beginTransaction();

            $sql = "UPDATE Pet SET active = FALSE WHERE id = :pet_id AND user_id = :user_id";
            $params = [
                ':pet_id'  => $deletePetDTO->getPetId(),
                ':user_id' => $deletePetDTO->getUserId()
            ];

            $rows = $this->database->execute($sql, $params);

            $this->database->commit();

            return $rows > 0;
        } catch (\Exception $e) {
            throw new \Exception('Error deleting pet: ' . $e->getMessage());
        }
    }

    public function update(UpdatePetDTO $updatePetDTO): void
    {
        try {
            $this->database->beginTransaction();

            $sql = "UPDATE Pet SET name = :name, type = :type, gender = :gender WHERE id = :id AND active = TRUE";
            $params = [
                ':name' => $updatePetDTO->getName(),
                ':type' => $updatePetDTO->getType(),
                ':gender' => $updatePetDTO->getGender(),
                ':id' => $updatePetDTO->getId()
            ];

            $this->database->execute($sql, $params);

            $this->database->commit();
        } catch (\Exception $e) {
            throw new \Exception('Error updating pet: ' . $e->getMessage());
        }
    }
}