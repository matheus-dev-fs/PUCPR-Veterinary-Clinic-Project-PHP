<?php
declare(strict_types=1);

namespace app\repositories\interfaces;

interface ServiceRepositoryInterface
{
    public function getAll(): array;
}