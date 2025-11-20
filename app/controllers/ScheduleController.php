<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class ScheduleController extends Controller
{
    public function index(): void
    {
        $this->view('schedule/index', [
            'view' => 'schedule/index'
        ]);
    }
}