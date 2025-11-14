<?php
require_once '../app/core/Router.php';

require_once __DIR__ . '/../vendor/autoload.php';

$url = $_GET['url'] ?? '';

$router = new Router();
$router->dispatch($url);
?>