<?php

require_once '../app/core/Controller.php';

class HttpErrorController extends Controller
{
    public function notFound()
    {
        $this->view('errors/404');
    }
}
