<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\ServiceRepository;

class ServiceService
{
    private ServiceRepository $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
    }
}