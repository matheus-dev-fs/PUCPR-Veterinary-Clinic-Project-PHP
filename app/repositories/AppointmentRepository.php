<?php
declare(strict_types=1);

namespace app\repositories;

use app\core\Repository;
use app\dtos\CreateAppointmentDTO;
use app\models\Appointment;
use app\mappers\AppointmentMapper;
use app\dtos\AppointmentSummaryDTO;
use app\dtos\DeleteAppointmentDTO;
use app\repositories\interfaces\AppointmentRepositoryInterface;

class AppointmentRepository extends Repository implements AppointmentRepositoryInterface
{
    public function findById(int $id): ?Appointment
    {
        try {
            $sql = "SELECT * FROM Appointment WHERE id = :id AND active = TRUE";
            $params = [':id' => $id];

            $result = $this->database->fetch($sql, $params);

            if ($result === false) {
                return null;
            }

            $appointment = AppointmentMapper::toAppointment($result);

            return $appointment;
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving appointment by ID: ' . $e->getMessage());
        }
    }

    public function save(CreateAppointmentDTO $createAppointmentDTO): ?Appointment
    {
        try {
            $this->database->beginTransaction();

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

            $this->database->commit();

            return new Appointment(
                $lastInsertId,
                $createAppointmentDTO->getPetId(),
                $createAppointmentDTO->getUserId(),
                $createAppointmentDTO->getServiceId(),
                $createAppointmentDTO->getInfos(),
                new \DateTime($createAppointmentDTO->getDate())
            );
        } catch (\Exception $e) {
            throw new \Exception('Error saving appointment: ' . $e->getMessage());
        }
    }

    public function getSummaryData(int $appointmentId): ?AppointmentSummaryDTO
    {
        try {
            $sql = "SELECT 
                        p.name AS pet_name,
                        u.name AS tutor_name,
                        s.name AS service_name,
                        a.appointment_date,
                        a.infos
                    FROM 
                        Appointment a
                    JOIN 
                        Pet p 
                    ON a.pet_id = p.id
                    JOIN 
                        User u 
                    ON 
                    a.user_id = u.id
                    JOIN 
                        Service s 
                    ON 
                        a.service_id = s.id
                    WHERE a.id = :appointment_id AND a.active = TRUE";
            $params = [':appointment_id' => $appointmentId];

            $result = $this->database->fetch($sql, $params);

            if ($result === null) {
                return null;
            }

            return AppointmentMapper::toAppointmentSummaryDTO($result);
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving appointment summary: ' . $e->getMessage());
        }
    }

    public function getAllByUserId(int $userId): array
    {
        try {
           $sql = "SELECT 
                        a.id,
                        p.name AS pet_name,
                        u.name AS tutor_name,
                        s.name AS service_name,
                        a.appointment_date,
                        a.infos
                    FROM 
                        Appointment a
                    JOIN 
                        Pet p 
                    ON a.pet_id = p.id
                    JOIN 
                        User u 
                    ON 
                    a.user_id = u.id
                    JOIN 
                        Service s 
                    ON 
                        a.service_id = s.id
                    WHERE a.user_id = :user_id AND a.active = TRUE";
            $params = [':user_id' => $userId];

            $results = $this->database->fetchAll($sql, $params);

            return AppointmentMapper::toAppointmentDTOArray($results);
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving appointments by user ID: ' . $e->getMessage());
        }
    }

    public function delete(DeleteAppointmentDTO $deleteAppointmentDTO): bool
    {
        try {
            $this->database->beginTransaction();

            $sql = "UPDATE Appointment SET active = FALSE WHERE id = :id";
            $params = [':id' => $deleteAppointmentDTO->getAppointmentId()];
            $rows = $this->database->execute($sql, $params);

            $this->database->commit();
            return $rows > 0;
        } catch (\Exception $e) {
            throw new \Exception('Error deleting appointment: ' . $e->getMessage());
        }
    }
}