<?php 
declare(strict_types=1);

namespace app\responses;

use app\dtos\CreateAppointmentDTO;
use app\models\Appointment;

class AppointmentResult extends ResponseResult
{
    public function getCreateAppointmentDTO(): ?Appointment
    {
        return $this->entity;
    }
}