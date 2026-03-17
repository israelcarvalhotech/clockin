<?php

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        echo "<h1>ClockIn</h1>";
        echo "<p>Sistema de controle de ponto eletrônico.</p>";
    }
}