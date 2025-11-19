<?php 
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class PetsController extends Controller
{
    public function new(): void
    {
        $this->view('pets/new');
    }
}
?>