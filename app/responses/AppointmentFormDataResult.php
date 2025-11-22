<?php 
declare(strict_types=1);

namespace app\responses;

use app\dtos\AppointmentFormDataDTO;

class AppointmentFormDataResult extends ResponseResult
{
    public function getAppointmentFormDataDTO(): ?AppointmentFormDataDTO
    {
        return $this->entity;
    }
}