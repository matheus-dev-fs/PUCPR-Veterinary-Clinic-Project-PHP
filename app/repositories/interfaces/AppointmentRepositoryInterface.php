<?php
declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\Appointment;
use app\dtos\CreateAppointmentDTO;
use app\dtos\AppointmentSummaryDTO;
use app\dtos\DeleteAppointmentDTO;

interface AppointmentRepositoryInterface
{
    public function findById(int $id): ?Appointment;
    public function findByPetId(int $petId): ?Appointment;
    public function save(CreateAppointmentDTO $createAppointmentDTO): ?Appointment;
    public function getSummaryData(int $appointmentId): ?AppointmentSummaryDTO;
    public function getAllByUserId(int $userId): array;
    public function delete(DeleteAppointmentDTO $deleteAppointmentDTO): bool;
}