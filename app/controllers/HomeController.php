<?php

require_once '../app/core/Controller.php';

class HomeController extends Controller{
    public function index() {
        // Logic for handling the home page request
        $this->view('home/index');
    }

}