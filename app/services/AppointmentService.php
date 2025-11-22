<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\AppointmentRepository;
use app\core\Database;
use app\repositories\PetRepository;
use app\repositories\ServiceRepository;
use app\responses\AppointmentFormDataResult;
use app\core\AuthHelper;
use app\dtos\AppointmentFormDataDTO;

class AppointmentService
{
    private AppointmentRepository $appointmentRepository;
    private PetRepository $petRepository;
    private ServiceRepository $serviceRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository(Database::getInstance());
        $this->petRepository = new PetRepository(Database::getInstance());
        $this->serviceRepository = new ServiceRepository(Database::getInstance());
    }

    public function getFormData(): AppointmentFormDataResult {
        $pets = $this->petRepository->getAllByUserId(AuthHelper::getUserLoggedId());
        $services = $this->serviceRepository->getAll();

        $appointmentFormDataDTO = new AppointmentFormDataDTO($pets, $services);
        return new AppointmentFormDataResult($appointmentFormDataDTO);
    }
}