<?php

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Session;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ClockController;

Session::start();

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/login', AuthController::class, 'showLogin');
$router->post('/login', AuthController::class, 'login');
$router->get('/logout', AuthController::class, 'logout');
$router->get('/clock', ClockController::class, 'index');
$router->post('/clock', ClockController::class, 'punch');

$router->dispatch();