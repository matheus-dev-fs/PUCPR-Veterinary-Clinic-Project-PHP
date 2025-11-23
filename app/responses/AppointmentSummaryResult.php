<?php
declare(strict_types=1);

namespace app\responses;

use app\dtos\AppointmentSummaryDTO;

class AppointmentSummaryResult extends ResponseResult
{
    public function getAppointmentSummary(): ?AppointmentSummaryDTO
    {
        return $this->entity;
    }
}
