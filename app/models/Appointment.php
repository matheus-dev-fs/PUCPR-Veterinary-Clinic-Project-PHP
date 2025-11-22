<?php 
declare(strict_types=1);

namespace app\models;

class Appointment 
{
    private int $id;
    private int $petId;
    private int $serviceId;
    private \DateTime $appointmentDate;
    private string $infos;

    public function __construct(
        int $id, 
        int $petId, 
        int $serviceId, 
        \DateTime $appointmentDate, 
        string $infos
    ) {
        $this->id = $id;
        $this->petId = $petId;
        $this->serviceId = $serviceId;
        $this->appointmentDate = $appointmentDate;
        $this->infos = $infos;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPetId(): int {
        return $this->petId;
    }

    public function getServiceId(): int {
        return $this->serviceId;
    }

    public function getAppointmentDate(): \DateTime {
        return $this->appointmentDate;
    }
    
    public function getInfos(): string {
        return $this->infos;
    }
}