<?php

declare(strict_types=1);

namespace app\dtos;

class AppointmentSummaryDTO
{
    public function __construct(
        private readonly string $petName,
        private readonly string $tutorName,
        private readonly string $serviceName,
        private readonly string $infos,
        private readonly string $appointmentDate,
    ) {}

    public function getPetName(): string
    {
        return $this->petName;
    }

    public function getTutorName(): string
    {
        return $this->tutorName;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getInfos(): string
    {
        return $this->infos;
    }

    public function getAppointmentDate(): string
    {
        return (new \DateTime($this->appointmentDate))->format('d/m/Y');
    }
}
