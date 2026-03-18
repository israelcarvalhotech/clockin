<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $host = getenv('DB_HOST') ?: 'db';
            $dbname = getenv('DB_NAME') ?: 'clockin';
            $user = getenv('DB_USER') ?: 'clockin_user';
            $pass = getenv('DB_PASS') ?: 'clockin_pass';

            try {
                self::$connection = new PDO(
                    "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}