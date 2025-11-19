<?php 
declare(strict_types=1);

namespace app\core;

abstract class Repository 
{
    protected Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public abstract function findById(int $id): ?object;
}