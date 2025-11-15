<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\AppointmentRepository;

class AppointmentService
{
    private AppointmentRepository $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
    }
}