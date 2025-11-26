<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class WelcomeController extends Controller
{
    public function index(): void
    {
        $this->ensureAuthenticated();

        $this->view('welcome/index', [
            'view' => 'welcome/index'
        ]);
    }
}