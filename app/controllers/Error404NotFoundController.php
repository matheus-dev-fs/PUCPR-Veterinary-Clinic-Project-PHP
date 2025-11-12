<?php

require_once '../app/core/Controller.php';

class Error404NotFoundController extends Controller
{
    public function index()
    {
        $this->view('404/index');
    }
}
