<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class FormActionController extends Controller {
    public function index() {
        $this->view('formAction/index');
    }

}