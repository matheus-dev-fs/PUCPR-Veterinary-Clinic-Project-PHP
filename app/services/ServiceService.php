<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\ServiceRepository;
use app\core\Database;
use app\repositories\interfaces\ServiceRepositoryInterface;

class ServiceService
{
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository(Database::getInstance());
    }
}