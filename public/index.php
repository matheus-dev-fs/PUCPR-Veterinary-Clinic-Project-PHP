<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Router;

$url = $_GET['url'] ?? '';

$router = new Router();
$router->dispatch($url);
?>