<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Database;

class HomeController extends Controller
{
    public function index()
    {
        $database = Database::getInstance();
        $database->connect();

        // $client = $database->fetch('SELECT * FROM Clientes WHERE id = :id', ['id' => 1]);
        // $clients = $database->fetchAll('SELECT * FROM Clientes');
        // dd($client, $clients);
        // exit;

        $this->view('home/index');
    }
}
