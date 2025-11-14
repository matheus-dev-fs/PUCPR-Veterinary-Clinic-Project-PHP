<?php
declare(strict_types=1);

namespace app\core;

use app\controllers\errors\HttpErrorController;

class Router
{
    public function dispatch(string $url): void
    {
        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        $controllerName = $parts[0] ?? 'Home';
        $controllerName =  'app\controllers\\' . ucfirst($controllerName) . 'Controller';

        $action = $parts[1] ?? 'index';

        if (!class_exists($controllerName)) {
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $params = array_slice($parts, 2);
        call_user_func_array([$controller, $action], $params);
    }
}
