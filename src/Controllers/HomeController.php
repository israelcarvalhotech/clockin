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

        header('Location: /clock');
        exit;
    }
}