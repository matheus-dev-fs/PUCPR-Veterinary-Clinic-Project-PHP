<?php

require_once '../app/core/Controller.php';

class FormActionController extends Controller{
    public function index() {
        $this->view('formAction/index');
    }

}