<?php

namespace App\Controllers;

use App\Core\Session;

class HomeController
{
    public function index(): void
    {
        if (!Session::isLoggedIn()) {
            header('Location: /login');
            exit;
        }

        $userName = Session::get('user_name');
        echo "<h1>Bem-vindo, {$userName}!</h1>";
        echo "<p><a href='/logout'>Sair</a></p>";
    }
}