<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\mappers\ServiceMapper;
use app\models\Service;

class ServiceRepository extends Repository
{
    public function findById(int $id): ?Service
    {
        try {
            $sql = "SELECT * FROM `Service` WHERE `id` = :id LIMIT 1";
            $params = ['id' => $id];
            $result = $this->database->fetch($sql, $params);

            if ($result === false) {
                return null;
            }

            $mapper = new ServiceMapper();
            return $mapper->toService($result);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching service by ID: ' . $e->getMessage());
        }
    }

    public function findByName(string $name): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function existsByName(string $name): bool
    {
        throw new \Exception('Not implemented');
    }

    public function getAll(): array {
        try {
            $sql = "SELECT * FROM `Service`";
            $results = $this->database->fetchAll($sql);
            $mapper = new ServiceMapper();
            return $mapper->toServiceArray($results);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching services: ' . $e->getMessage());
        }
    }
}