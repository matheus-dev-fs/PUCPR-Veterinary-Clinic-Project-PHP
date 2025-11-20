<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'view' => 'home/index'
        ]);
    }
}
