<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreateAppointmentDTO;
use app\models\Appointment;

class AppointmentRepository extends Repository
{
    public function findById(int $id): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function findByName(string $name): ?object
    {
        throw new \Exception('Not implemented');
    }

    public function existsByName(string $name): bool
    {
        throw new \Exception('Not implemented');
    }

    public function save(CreateAppointmentDTO $createAppointmentDTO): ?Appointment
    {
        try {
            $sql = "INSERT INTO Appointment (pet_id, user_id, service_id, appointment_date, infos) 
                    VALUES (:pet_id, :user_id, :service_id, :appointment_date, :infos)";
            $params = [
                ':pet_id'          => $createAppointmentDTO->getPetId(),
                ':user_id'         => $createAppointmentDTO->getUserId(),
                ':service_id'      => $createAppointmentDTO->getServiceId(),
                ':appointment_date'=> $createAppointmentDTO->getDate(),
                ':infos'           => $createAppointmentDTO->getInfos()
            ];

            $rows = $this->database->execute($sql, $params);

            if ($rows === 0) {
                return null;
            }

            $lastInsertId = (int)$this->database->lastInsertId();

            return new Appointment(
                $lastInsertId,
                $createAppointmentDTO->getPetId(),
                $createAppointmentDTO->getServiceId(),
                new \DateTime($createAppointmentDTO->getDate()),
                $createAppointmentDTO->getInfos()
            );
        } catch (\Exception $e) {
            throw new \Exception('Error saving appointment: ' . $e->getMessage());
        }
    }
}