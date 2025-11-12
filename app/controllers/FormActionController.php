<?php

require_once '../app/core/Controller.php';

class FormActionController extends Controller{
    public function index() {
        // Logic for handling the home page request
        $this->view('home/index');
    }

}