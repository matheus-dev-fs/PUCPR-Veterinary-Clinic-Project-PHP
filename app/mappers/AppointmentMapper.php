<?php

declare(strict_types=1);

namespace app\mappers;

use app\dtos\AppointmentSummaryDTO;
use app\models\Appointment;
use app\dtos\CreateAppointmentDTO;
use app\dtos\AppointmentDTO;
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
                $item['user_id'],
                $item['service_id'],
                $item['infos'],
                new \DateTime($item['appointment_date'])
            );

            $array[] = $appointment;
        }

        return $array;
    }

    public static function toAppointment(array $data): Appointment
    {
        $appointment = new Appointment(
            $data['id'],
            $data['pet_id'],
            $data['user_id'],
            $data['service_id'],
            $data['infos'],
            new \DateTime($data['appointment_date']),
        );

        return $appointment;
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

    public static function toAppointmentSummaryDTO(array $data): AppointmentSummaryDTO
    {
        return new AppointmentSummaryDTO(
            $data['pet_name'],
            $data['tutor_name'],
            $data['service_name'],
            $data['infos'],
            $data['appointment_date']
        );
    }

    public static function toAppointmentDTOArray(array $data): array
    {
        $array = [];

        foreach ($data as $item) {
            $appointmentDTO = new AppointmentDTO(
                $item['id'],
                $item['pet_name'],
                $item['tutor_name'],
                $item['service_name'],
                $item['infos'],
                $item['appointment_date']
            );

            $array[] = $appointmentDTO;
        }

        return $array;
    }
}
