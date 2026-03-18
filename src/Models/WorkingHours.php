<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class WorkingHours
{
    public static function findByUserAndDate(int $userId, string $date): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM working_hours WHERE user_id = :user_id AND work_date = :work_date LIMIT 1");
        $stmt->execute(['user_id' => $userId, 'work_date' => $date]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO working_hours (user_id, work_date, time1) VALUES (:user_id, :work_date, :time1)"
        );
        $stmt->execute([
            'user_id' => $data['user_id'],
            'work_date' => $data['work_date'],
            'time1' => $data['time'],
        ]);
        return (int) $db->lastInsertId();
    }

    public static function punch(int $id, string $timeColumn, string $time): void
    {
        $db = Database::getConnection();
        $allowed = ['time1', 'time2', 'time3', 'time4'];
        if (!in_array($timeColumn, $allowed)) {
            throw new \InvalidArgumentException("Coluna inválida: {$timeColumn}");
        }
        $stmt = $db->prepare("UPDATE working_hours SET {$timeColumn} = :time WHERE id = :id");
        $stmt->execute(['time' => $time, 'id' => $id]);
    }

    public static function getNextTimeColumn(?array $record): ?string
    {
        if (!$record) return 'time1';
        if (empty($record['time1'])) return 'time1';
        if (empty($record['time2'])) return 'time2';
        if (empty($record['time3'])) return 'time3';
        if (empty($record['time4'])) return 'time4';
        return null;
    }
}