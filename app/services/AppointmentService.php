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
use app\dtos\DeleteAppointmentDTO;
use app\repositories\interfaces\AppointmentRepositoryInterface;
use app\repositories\interfaces\PetRepositoryInterface;
use app\repositories\interfaces\ServiceRepositoryInterface;
use app\responses\AppointmentResult;
use app\responses\AppointmentsResult;

class AppointmentService
{
    private AppointmentRepositoryInterface $appointmentRepository;
    private PetRepositoryInterface $petRepository;
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository(Database::getInstance());
        $this->petRepository = new PetRepository(Database::getInstance());
        $this->serviceRepository = new ServiceRepository(Database::getInstance());
    }

    public function getFormData(): AppointmentFormDataResult
    {
        try {
            $pets = $this->petRepository->getAllByUserId(AuthHelper::getUserLoggedId());

            if (empty($pets)) {
                return new AppointmentFormDataResult(null, ['no_pets' => true]);
            }

            $services = $this->serviceRepository->getAll();

            if (empty($services)) {
                return new AppointmentFormDataResult(null, ['no_services' => true]);
            }

            $appointmentFormDataDTO = new AppointmentFormDataDTO($pets, $services);
            return new AppointmentFormDataResult($appointmentFormDataDTO);
        } catch (\Exception $e) {
            return new AppointmentFormDataResult(null, ['db_error' => 'Error retrieving form data: ' . $e->getMessage()]);
        }
    }

    public function save(CreateAppointmentDTO $createAppointmentDTO): AppointmentResult
    {
        try {
            $errors = $this->validateData($createAppointmentDTO);

            if (!empty($errors)) {
                return new AppointmentResult(null, $errors);
            }

            if (!$this->checkPetAuthorization($createAppointmentDTO->getPetId())) {
                return new AppointmentResult(null, ['unauthorized' => true]);
            }

            $appointment = $this->appointmentRepository->save($createAppointmentDTO);
            return new AppointmentResult($appointment);
        } catch (\Exception $e) {
            return new AppointmentResult(null, ['db_error' => 'Error saving appointment: ' . $e->getMessage()]);
        }
    }

    public function getSummaryData(int $appointmentId): AppointmentSummaryResult
    {
        try {
            $appointment = $this->appointmentRepository->findById($appointmentId);

            if ($appointment === null) {
                return new AppointmentSummaryResult(null, ['not_found' => true]);
            }

            if (!$this->checkAppointmentAuthorization($appointmentId)) {
                return new AppointmentSummaryResult(null, ['unauthorized' => true]);
            }

            $appointmentSummaryDTO = $this->appointmentRepository->getSummaryData($appointmentId);

            return new AppointmentSummaryResult($appointmentSummaryDTO);
        } catch (\Exception $e) {
            return new AppointmentSummaryResult(null, ['db_error' => 'Error retrieving appointment summary: ' . $e->getMessage()]);
        }
    }

    public function getAllByUserId(int $userId): AppointmentsResult
    {
        try {
            $appointments = $this->appointmentRepository->getAllByUserId($userId);

            if (empty($appointments)) {
                return new AppointmentsResult(null, ['no_appointments' => true]);
            }

            return new AppointmentsResult($appointments);
        } catch (\Exception $e) {
            return new AppointmentsResult(null, ['db_error' => 'Error retrieving appointments: ' . $e->getMessage()]);
        }
    }

    public function delete(DeleteAppointmentDTO $deleteAppointmentDTO): AppointmentResult
    {
        try {
            $validatedIdResult = $this->validateAppointmentId($deleteAppointmentDTO->getAppointmentId());
            
            if (!$validatedIdResult->isSuccess()) {
                return $validatedIdResult;
            }

            $appointment = $this->appointmentRepository->findById($deleteAppointmentDTO->getAppointmentId());

            if ($appointment === null) {
                return new AppointmentResult(null, ['not_found' => true]);
            }

            if (!$this->checkAppointmentAuthorization($deleteAppointmentDTO->getAppointmentId())) {
                return new AppointmentResult(null, ['unauthorized' => true]);
            }

            $deleted = $this->appointmentRepository->delete($deleteAppointmentDTO);
            if (!$deleted) {
                return new AppointmentResult(null, ['deletion_failed' => true]);
            }

            return new AppointmentResult($appointment);
        } catch (\Exception $e) {
            return new AppointmentResult(null, ['db_error' => 'Error deleting appointment: ' . $e->getMessage()]);
        }
    }

    private function validateData(CreateAppointmentDTO $createAppointmentDTO): array
    {
        $errors = [];

        $errors = \array_merge($errors, $this->validatePetId($createAppointmentDTO->getPetId()));
        $errors = \array_merge($errors, $this->validateServiceId($createAppointmentDTO->getServiceId()));
        $errors = \array_merge($errors, $this->validateAppointmentDate($createAppointmentDTO->getDate()));
        return $errors;
    }

    private function validateAppointmentId(int $appointmentId): AppointmentResult
    {
        if (empty($appointmentId)) {
            return new AppointmentResult(null, ['invalid_id' => true]);
        }

        return new AppointmentResult(true);
    }

    private function validatePetId(int $petId): array
    {
        $errors = [];
        try {
            if (empty($petId)) {
                $errors['required_pet'] = true;
            } else if ($this->petRepository->findById($petId) === null) {
                $errors['invalid_pet'] = true;
            }
        } catch (\Exception $e) {
            $errors['db_error'] = 'Error validating pet ID: ' . $e->getMessage();
        }

        return $errors;
    }

    private function validateServiceId(int $serviceId): array
    {
        $errors = [];

        try {
            if (empty($serviceId)) {
                $errors['required_service'] = true;
            } else if ($this->serviceRepository->findById($serviceId) === null) {
                $errors['invalid_service'] = true;
            }
        } catch (\Exception $e) {
            $errors['db_error'] = 'Error validating service ID: ' . $e->getMessage();
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
        try {
            $pet = $this->petRepository->findById($petId);

            if ($pet === null) {
                return false;
            }

            if ($pet->getUserId() !== AuthHelper::getUserLoggedId()) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function checkAppointmentAuthorization(int $appointmentId): bool
    {
        try {
            $appointment = $this->appointmentRepository->findById($appointmentId);

            if ($appointment === null) {
                return false;
            }

            if ($appointment->getUserId() !== AuthHelper::getUserLoggedId()) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
