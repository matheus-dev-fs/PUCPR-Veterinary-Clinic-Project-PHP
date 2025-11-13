<?php

require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/HttpErrorController.php';
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
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $controller = new $controllerName();

        $action = $parts[1] ?? 'index';

        if (!method_exists($controller, $action)) {
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $params = array_slice($parts, 2);
        call_user_func_array([$controller, $action], $params);
    }
}
