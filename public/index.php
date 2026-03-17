<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;

$router = new Router();
$router->get('/', HomeController::class, 'index');
$router->dispatch();