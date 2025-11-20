<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreatePetDTO;
use app\dtos\DeletePetDTO;
use app\models\Pet;
use app\mappers\PetMapper;

class PetRepository extends Repository
{
    public function findById(int $id): ?Pet
    {
        try {
            $sql = "SELECT id, id_user, `name`, `type`, gender FROM Pets WHERE id = :id";
            $params = [':id' => $id];

            $result = $this->database->fetch($sql, $params);

            return $result === false ? null : $result;
        } catch (\Exception $e) {
            throw new \Exception('Error finding pet by ID: ' . $e->getMessage());
        }
    }

    public function save(CreatePetDTO $createPetDTO): ?Pet
    {
        try {
            $sql = "INSERT INTO Pets (id_user, name, type, gender) VALUES (:id_user, :name, :type, :gender)";
            $params = [
                ':id_user' => $createPetDTO->getIdUser(),
                ':name'    => $createPetDTO->getName(),
                ':type'    => $createPetDTO->getType(),
                ':gender'  => $createPetDTO->getGender()
            ];

            $rows = $this->database->execute($sql, $params);

            if ($rows === 0) {
                return null;
            }

            $lastInsertId = (int)$this->database->lastInsertId();

            return new Pet(
                $lastInsertId,
                $createPetDTO->getIdUser(),
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
            $sql = "SELECT id, id_user, `name`, `type`, gender FROM Pets WHERE id_user = :id_user";
            $params = [':id_user' => $userId];

            $results = $this->database->fetchAll($sql, $params);
            return PetMapper::toPetArray($results);
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving pets: ' . $e->getMessage());
        }
    }

    public function delete(DeletePetDTO $deletePetDTO): bool
    {
        try {
            $sql = "DELETE FROM Pets WHERE id = :pet_id AND id_user = :user_id";
            $params = [
                ':pet_id'  => $deletePetDTO->getPetId(),
                ':user_id' => $deletePetDTO->getUserId()
            ];

            $rows = $this->database->execute($sql, $params);
            return $rows > 0;
        } catch (\Exception $e) {
            throw new \Exception('Error deleting pet: ' . $e->getMessage());
        }
    }
}