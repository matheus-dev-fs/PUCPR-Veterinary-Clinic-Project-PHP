<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\AuthHelper;
use app\core\Controller;
use app\services\AppointmentService;
use app\core\RedirectHelper;
use app\dtos\CreateAppointmentDTO;
use app\mappers\AppointmentMapper;
use app\responses\AppointmentResult;

class AppointmentController extends Controller
{
    private AppointmentService $appointmentService;

    public function __construct()
    {
        $this->appointmentService = new AppointmentService();
    }

    public function index(): void
    {
        $this->view('schedule/index', [
            'view' => 'schedule/index'
        ]);
    }

    public function new(): void
    {
        $this->ensureAuthenticated();

        $appointmentFormDataResult = $this->appointmentService->getFormData();

        if (!$appointmentFormDataResult->isSuccess()) {
            $this->view('appointment/new', [
                'errors' => $appointmentFormDataResult->getErrors(),
                'old' => $_POST,
                'view' => 'appointment/new'
            ]);
            return;
        }   

        $AppointmentFormDataDTO = $appointmentFormDataResult->getAppointmentFormDataDTO();
        $data = [
            'services' => $AppointmentFormDataDTO->getServices(),
            'pets' => $AppointmentFormDataDTO->getPets(),
        ];

        $this->view('appointment/new', [
            'view' => 'appointment/new',
            'data' => $data
        ]);
    }

    public function create(): void
    {
        $this->ensureAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToAppointmentNew(...));

        $createAppointmentDTO = $this->getCreateAppointmentDTOFromPost();
        $appointmentResponseResult = $this->appointmentService->save($createAppointmentDTO);

        if (!$appointmentResponseResult->isSuccess()) {
            $errors = $appointmentResponseResult->getErrors();

            if ($this->shouldRedirectOnError($errors)) {
                $this->handleAppointmentResponseErrors($appointmentResponseResult);
            }
        }

        RedirectHelper::redirectToAppointmentSummary($appointmentResponseResult->getCreateAppointmentDTO()->getId());
    }

    public function summary(int $appointmentInt): void {
        $this->ensureAuthenticated();

        if (!$this->isAppointmentIdValid($appointmentInt)) {
            RedirectHelper::redirectToHome();
        }

        $appointmentResult =$this->appointmentService->getSummaryData($appointmentInt);

        if (!$appointmentResult->isSuccess()) {
            $errors = $appointmentResult->getErrors();

            if (isset($errors['not_found'])) {
                RedirectHelper::redirectToHome();
            }

            if (isset($errors['unauthorized'])) {
                RedirectHelper::redirectTo403();
            }
        }

        $appointment = $appointmentResult->getAppointmentSummary();
        $this->view('appointment/summary', [
            'view' => 'appointment/summary',
            'appointment' => $appointment
        ]);
    }

    private function isAppointmentIdValid(?int $appointmentId): bool
    {
        return isset($appointmentId) && is_int($appointmentId) && $appointmentId > 0;
    }

    private function getCreateAppointmentDTOFromPost(): CreateAppointmentDTO
    {
        return AppointmentMapper::toCreateAppointmentDTO(
            $_POST['pets'] ?? null,
            AuthHelper::getUserLoggedId() ?? null,
            $_POST['service'] ?? null,
            $_POST['infos'] ?? null,
            $_POST['date'] ?? null
        );
    }

    private function handleAppointmentResponseErrors(AppointmentResult $result): void
    {
        if ($result->isSuccess()) {
            return;
        }

        $errors = $result->getErrors();

        if (isset($errors['required_pet']) || isset($errors['invalid_pet']) ||
            isset($errors['required_service']) || isset($errors['invalid_service']) ||
            isset($errors['required_date']) || isset($errors['invalid_date'])
        ) {
            $this->view('appointment/new', [
                'errors' => $errors,
                'old' => $_POST,
                'view' => 'appointment/new'
            ]);
            return;
        }

        if (isset($errors['unauthorized'])) {
            RedirectHelper::redirectTo403();
        }
    }

    private function shouldRedirectOnError(array $errors): bool
    {
        return isset($errors['required_pet']) || 
               isset($errors['invalid_pet']) ||
               isset($errors['required_service']) || 
               isset($errors['invalid_service']) ||
               isset($errors['required_date']) || 
               isset($errors['invalid_date']) ||
               isset($errors['not_found']) ||
               isset($errors['unauthorized']);
    }
}
