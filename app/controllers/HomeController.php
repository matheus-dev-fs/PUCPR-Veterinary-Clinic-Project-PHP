<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class HomeController extends Controller
{
    public function index()
    {
        $database = new Database();
        $database->connect();

        // $stmt = $database->query('SELECT * FROM Clientes WHERE id = :id', ['id' => 1]);
        // $clients = $stmt->fetchAll();
        // dd($clients);
        // exit;

        $this->view('home/index');
    }
}
