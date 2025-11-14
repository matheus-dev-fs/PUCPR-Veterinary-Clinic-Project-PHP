<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $this->view('about/index');
    }
}
