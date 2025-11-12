<?php

require_once '../app/core/Controller.php';

class ScheduleController extends Controller{
    public function index() {
        $this->view('schedule/index');
    }

}