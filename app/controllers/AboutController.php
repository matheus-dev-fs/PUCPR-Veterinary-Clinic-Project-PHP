<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class AboutController extends Controller
{
    public function index(): void
    {
        $this->view('about/index', [
            'view' => 'about/index'
        ]);
    }
}
