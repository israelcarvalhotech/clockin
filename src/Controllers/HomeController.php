<?php

namespace App\Controllers;

use App\Core\Database;

class HomeController
{
    public function index(): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT name, email FROM users LIMIT 1");
        $user = $stmt->fetch();

        echo "<h1>ClockIn</h1>";
        echo "<p>Conexão com banco OK!</p>";
        echo "<p>Admin: {$user['name']} - {$user['email']}</p>";
    }
}