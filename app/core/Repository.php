<?php 
declare(strict_types=1);

namespace app\core;

abstract class Repository 
{
    protected Database $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public abstract function findById(int $id): ?object;
}