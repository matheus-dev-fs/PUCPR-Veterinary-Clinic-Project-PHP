<?php
require_once '../app/core/Router.php';

$url = $_GET['url'] ?? '';

$router = new Router();
$router->dispatch($url);
?>