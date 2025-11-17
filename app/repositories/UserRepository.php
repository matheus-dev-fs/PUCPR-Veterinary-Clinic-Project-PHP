<?php 
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreateUserDTO;
use app\models\User;

class UserRepository extends Repository
{
    public function findById(int $id): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function findByName(string $name): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function existsByEmail(string $email): bool
    {
        $sql = "SELECT * FROM User WHERE email = :email";
        $params = [':email' => $email];

        $result = $this->database->fetch($sql, $params);

        return $result !== false;
    }

    public function save(CreateUserDTO $userDTO): ?User
    {
        try {
            $sql = "INSERT INTO User (name, email, password, phone) VALUES (:name, :email, :password, :phone)";
            $params = [
                ':name'     => $userDTO->getName(),
                ':email'    => $userDTO->getEmail(),
                ':password' => $userDTO->getPassword(),
                ':phone'    => $userDTO->getPhone()
            ];

            $rows = $this->database->execute($sql, $params);

            if ($rows === 0) {
                return null;
            }

            $lastInsertId = (int)$this->database->lastInsertId();

            return new User(
                id: $lastInsertId,
                name: $userDTO->getName(),
                email: $userDTO->getEmail(),
                password: $userDTO->getPassword(),
                phone: $userDTO->getPhone(),
                createdAt: new \DateTime()
            );
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to save user: ' . $e->getMessage());
        }
    }
}