<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\AppointmentRepository;
use app\core\Database;

class AppointmentService
{
    private AppointmentRepository $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository(Database::getInstance());
    }
}