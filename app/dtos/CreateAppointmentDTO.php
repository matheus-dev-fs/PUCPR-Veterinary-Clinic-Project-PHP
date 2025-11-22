<?php
declare(strict_types=1);

namespace app\dtos;

class CreateAppointmentDTO {
    private readonly int $petId;
    private readonly int $serviceId;
    private readonly string $infos;
    private readonly string $date;

    public function __construct(
        int $petId,
        int $serviceId,
        string $infos,
        string $date
    ) {
        $this->petId = $petId;
        $this->serviceId = $serviceId;
        $this->date = $date;
        $this->infos = $infos;
    }

    public function getPetId(): int {
        return $this->petId;
    }

    public function getServiceId(): int {
        return $this->serviceId;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function getInfos(): string {
        return $this->infos;
    }
}