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
use app\responses\AppointmentSummaryResult;
use app\dtos\CreateAppointmentDTO;
use app\responses\AppointmentResult;

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

    public function getFormData(): AppointmentFormDataResult
    {
        $pets = $this->petRepository->getAllByUserId(AuthHelper::getUserLoggedId());
        $services = $this->serviceRepository->getAll();

        $appointmentFormDataDTO = new AppointmentFormDataDTO($pets, $services);
        return new AppointmentFormDataResult($appointmentFormDataDTO);
    }

    public function save(CreateAppointmentDTO $createAppointmentDTO): AppointmentResult
    {
        $errors = $this->validateData($createAppointmentDTO);

        if (!empty($errors)) {
            return new AppointmentResult(null, $errors);
        }

        if (!$this->checkPetAuthorization($createAppointmentDTO->getPetId())) {
            return new AppointmentResult(null, ['unauthorized' => true]);
        }

        $appointment = $this->appointmentRepository->save($createAppointmentDTO);
        return new AppointmentResult($appointment);
    }

    public function getSummaryData(int $appointmentId): AppointmentSummaryResult
    {
        $appointment = $this->appointmentRepository->findById($appointmentId);

         if ($appointment === null) {
            return new AppointmentSummaryResult(null, ['not_found' => true]);
        }

        if (!$this->checkAppointmentAuthorization($appointmentId)) {
            return new AppointmentSummaryResult(null, ['unauthorized' => true]);
        }

        $appointmentSummaryDTO = $this->appointmentRepository->getSummaryData($appointmentId);

        return new AppointmentSummaryResult($appointmentSummaryDTO);
    }

    private function validateData(CreateAppointmentDTO $createAppointmentDTO): array
    {
        $errors = [];

        $errors = \array_merge($errors, $this->validatePetId($createAppointmentDTO->getPetId()));
        $errors = \array_merge($errors, $this->validateServiceId($createAppointmentDTO->getServiceId()));
        $errors = \array_merge($errors, $this->validateAppointmentDate($createAppointmentDTO->getDate()));
        return $errors;
    }

    private function validatePetId(int $petId): array
    {
        $errors = [];

        if (empty($petId)) {
            $errors['required_pet'] = true;
        } else if ($this->petRepository->findById($petId) === null) {
            $errors['invalid_pet'] = true;
        }

        return $errors;
    }

    private function validateServiceId(int $serviceId): array
    {
        $errors = [];

        if (empty($serviceId)) {
            $errors['required_service'] = true;
        } else if ($this->serviceRepository->findById($serviceId) === null) {
            $errors['invalid_service'] = true;
        }

        return $errors;
    }

    private function validateAppointmentDate(?string $appointmentDate): array
    {
        $errors = [];

        if (empty($appointmentDate)) {
            $errors['required_date'] = true;
        } else {
            $dateTime = \DateTime::createFromFormat('Y-m-d', $appointmentDate);
            if ($dateTime === false || $dateTime->format('Y-m-d') !== $appointmentDate) {
                $errors['invalid_date'] = true;
            }
        }

        return $errors;
    }

    private function checkPetAuthorization(int $petId): bool
    {
        $pet = $this->petRepository->findById($petId);

        if ($pet === null) {
            return false;
        }

        if ($pet->getUserId() !== AuthHelper::getUserLoggedId()) {
            return false;
        }

        return true;
    }

    private function checkAppointmentAuthorization(int $appointmentId): bool
    {
        $appointment = $this->appointmentRepository->findById($appointmentId);

        if ($appointment === null) {
            return false;
        }

        if ($appointment->getUserId() !== AuthHelper::getUserLoggedId()) {
            return false;
        }

        return true;
    }
}
