<?php
declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\Service;

interface ServiceRepositoryInterface
{
    public function findById(int $id): ?Service;
    public function getAll(): array;
}