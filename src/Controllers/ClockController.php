<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\Csrf;
use App\Models\WorkingHours;

class ClockController
{
    public function index(): void
    {
        if (!Session::isLoggedIn()) {
            header('Location: /login');
            exit;
        }

        $userId = Session::get('user_id');
        $userName = Session::get('user_name');
        $today = date('Y-m-d');
        $record = WorkingHours::findByUserAndDate($userId, $today);
        $nextTime = WorkingHours::getNextTimeColumn($record);
        $flash = Session::getFlash();

        ob_start();
        require __DIR__ . '/../../views/clock/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../views/layouts/main.php';
    }

    public function punch(): void
    {
        if (!Session::isLoggedIn()) {
            header('Location: /login');
            exit;
        }

        if (!Csrf::verify()) {
            Session::setFlash('error', 'Token de segurança inválido.');
            header('Location: /clock');
            exit;
        }

        $userId = Session::get('user_id');
        $today = date('Y-m-d');
        $now = date('H:i:s');
        $record = WorkingHours::findByUserAndDate($userId, $today);
        $nextTime = WorkingHours::getNextTimeColumn($record);

        if ($nextTime === null) {
            Session::setFlash('error', 'Você já fez os 4 batimentos do dia!');
            header('Location: /clock');
            exit;
        }

        if (!$record) {
            WorkingHours::create([
                'user_id' => $userId,
                'work_date' => $today,
                'time' => $now,
            ]);
        } else {
            WorkingHours::punch($record['id'], $nextTime, $now);
        }

        Session::setFlash('success', 'Ponto registrado com sucesso!');
        header('Location: /clock');
        exit;
    }
}