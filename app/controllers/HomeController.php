<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Logic for handling the home page request
        $this->view('home/index');
    }
}
