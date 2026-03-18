<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    public static function findByEmail(string $email): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function getAll(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT id, name, email, is_admin, created_at FROM users ORDER BY name");
        return $stmt->fetchAll();
    }

    public static function create(array $data): int
    {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO users (name, email, password, is_admin) VALUES (:name, :email, :password, :is_admin)"
        );
        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => $data['is_admin'] ?? false,
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $db = Database::getConnection();

        if (!empty($data['password'])) {
            $stmt = $db->prepare(
                "UPDATE users SET name = :name, email = :email, password = :password, is_admin = :is_admin WHERE id = :id"
            );
            $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'is_admin' => $data['is_admin'] ?? false,
                'id' => $id,
            ]);
        } else {
            $stmt = $db->prepare(
                "UPDATE users SET name = :name, email = :email, is_admin = :is_admin WHERE id = :id"
            );
            $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'is_admin' => $data['is_admin'] ?? false,
                'id' => $id,
            ]);
        }
    }

    public static function delete(int $id): void
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}