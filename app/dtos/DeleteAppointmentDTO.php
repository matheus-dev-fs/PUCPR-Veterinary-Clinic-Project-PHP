<?php
declare(strict_types=1);

namespace app\dtos;

class DeleteAppointmentDTO
{
    public function __construct(
        private readonly int $userId,
        private readonly int $appointmentId
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAppointmentId(): int
    {
        return $this->appointmentId;
    }
}