<?php 
declare(strict_types=1);

namespace app\mappers;

use app\models\Appointment;
use app\dtos\CreateAppointmentDTO;
use app\utils\Sanitizer;

class AppointmentMapper
{
    public static function toAppointmentArray(array $data): array
    {
        $array = [];

        foreach ($data as $item) {
            $appointment = new Appointment(
                $item['id'],
                $item['pet_id'],
                $item['service_id'],
                $item['date'],
                $item['infos']
            );

            $array[] = $appointment;
        }
        
        return $array;
    }

    public static function toCreateAppointmentDTO(
        string $petId,
        ?int $userId,
        string $serviceId,
        ?string $infos,
        ?string $appointmentDate
    ): CreateAppointmentDTO {
        return new CreateAppointmentDTO(
            (int) Sanitizer::sanitize($petId),
            $userId,
            (int) Sanitizer::sanitize($serviceId),
            Sanitizer::sanitize($infos),
            Sanitizer::sanitize($appointmentDate)
        );
    }
}