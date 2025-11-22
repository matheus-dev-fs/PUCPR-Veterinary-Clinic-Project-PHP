<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class AppointmentController extends Controller
{
    public function index(): void
    {
        $this->view('schedule/index', [
            'view' => 'schedule/index'
        ]);
    }

    public function new(): void
    {
        $this->view('appointment/new', [
            'view' => 'appointment/new'
        ]);
    }
}