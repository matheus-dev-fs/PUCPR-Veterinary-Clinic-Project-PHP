<?php 
declare(strict_types=1);

namespace app\models;

class Appointment 
{
    private int $id;
    private int $petId;
    private int $userId;
    private int $serviceId;
    private string $infos;
    private \DateTime $appointmentDate;

    public function __construct(
        int $id, 
        int $petId, 
        int $userId,
        int $serviceId, 
        string $infos,
        \DateTime $appointmentDate, 
    ) {
        $this->id = $id;
        $this->petId = $petId;
        $this->userId = $userId;
        $this->serviceId = $serviceId;
        $this->infos = $infos;
        $this->appointmentDate = $appointmentDate;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPetId(): int {
        return $this->petId;
    }

    public function getUserId(): int {
        return $this->userId;
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