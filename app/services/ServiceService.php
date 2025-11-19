<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\ServiceRepository;
use app\core\Database;

class ServiceService
{
    private ServiceRepository $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository(Database::getInstance());
    }
}