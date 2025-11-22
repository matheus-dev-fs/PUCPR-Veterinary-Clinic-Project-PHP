<?php 
declare(strict_types=1);

namespace app\mappers;
use app\models\Appointment;

class AppointmentMapper
{
    public function toAppointmentArray(array $data): array
    {
        $array = [];

        foreach ($data as $item) {
            $appointment = new Appointment(
                $item['id'],
                $item['pet_id'],
                $item['service_id'],
                $item['appointment_date'],
                $item['infos']
            );

            $array[] = $appointment;
        }
        
        return $array;
    }
}