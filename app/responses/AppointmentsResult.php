<?php 
declare(strict_types=1);

namespace app\responses;

use app\models\Appointment;

class AppointmentsResult extends ResponseResult
{
    public function getAppointments(): array
    {
        return $this->entity;
    }
}