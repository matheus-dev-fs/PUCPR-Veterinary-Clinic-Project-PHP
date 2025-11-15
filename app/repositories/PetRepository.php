<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;

class PetRepository extends Repository
{
    public function findById(int $id): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function findByName(string $name): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function existsByName(string $name): bool
    {
        throw new \Exception('Not implemented');
    }
}