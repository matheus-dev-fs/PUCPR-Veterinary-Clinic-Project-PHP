<?php

require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/Error404NotFoundController.php';
require_once '../app/controllers/ScheduleController.php';
require_once '../app/controllers/AboutController.php';
require_once '../app/controllers/FormActionController.php';

class Router
{
    public function dispatch(string $url): void
    {
        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        $controllerName = $parts[0] ?? 'Home';
        $controllerName = ucfirst($controllerName) . 'Controller';

        if (!class_exists($controllerName)) {
            $controllerName = 'Error404NotFoundController';
        }

        $controller = new $controllerName();
        $controller->index();
    }
}
