<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\mappers\ServiceMapper;
use app\models\Service;
use app\repositories\interfaces\ServiceRepositoryInterface;

class ServiceRepository extends Repository implements ServiceRepositoryInterface
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