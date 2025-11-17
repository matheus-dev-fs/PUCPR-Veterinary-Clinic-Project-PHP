<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }
}
