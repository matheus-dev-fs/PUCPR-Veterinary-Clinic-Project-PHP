<?php
declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\Appointment;
use app\dtos\CreateAppointmentDTO;
use app\dtos\AppointmentSummaryDTO;

interface AppointmentRepositoryInterface
{
    public function findById(int $id): ?Appointment;
    public function save(CreateAppointmentDTO $createAppointmentDTO): ?Appointment;
    public function getSummaryData(int $appointmentId): ?AppointmentSummaryDTO;
    public function getAllByUserId(int $userId): array;
}