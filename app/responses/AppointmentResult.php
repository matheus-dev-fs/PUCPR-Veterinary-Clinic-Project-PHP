<?php 
declare(strict_types=1);

namespace app\responses;

use app\dtos\CreateAppointmentDTO;

class AppointmentResult extends ResponseResult
{
    public function getCreateAppointmentDTO(): ?CreateAppointmentDTO
    {
        return $this->entity;
    }
}