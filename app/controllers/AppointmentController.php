<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\services\AppointmentService;

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
}
