<?php 
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreateUserDTO;
use app\models\User;
use app\repositories\interfaces\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        throw new \Exception('Not implemented');
    }

    public function existsByEmail(string $email): bool
    {
        $sql = "SELECT * FROM User WHERE email = :email AND active = TRUE";
        $params = [':email' => $email];

        $result = $this->database->fetch($sql, $params);

        return $result !== false;
    }

    public function save(CreateUserDTO $userDTO): ?User
    {
        try {
            $this->database->beginTransaction();

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

            $this->database->commit();
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

    public function findByEmail(string $email): ?User
    {
        try {
            $sql = "SELECT * FROM User WHERE email = :email AND active = TRUE";
            $params = [':email' => $email];

            $result = $this->database->fetch($sql, $params);

            if ($result === false) {
                return null;
            }

            return new User(
                id: (int)$result['id'],
                name: $result['name'],
                email: $result['email'],
                password: $result['password'],
                phone: $result['phone'],
                createdAt: new \DateTime($result['created_at'])
            );
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to find user by email: ' . $e->getMessage());
        }
    }
}