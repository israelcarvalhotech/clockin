<?php

namespace App\Controllers;

use App\Core\Session;
use App\Models\WorkingHours;

class ReportController
{
    public function monthly(): void
    {
        if (!Session::isLoggedIn()) {
            header('Location: /login');
            exit;
        }

        $userId = Session::get('user_id');
        $userName = Session::get('user_name');
        $year = (int) ($_GET['year'] ?? date('Y'));
        $month = (int) ($_GET['month'] ?? date('m'));

        $records = WorkingHours::getMonthlyReport($userId, $year, $month);

        $totalSeconds = 0;
        foreach ($records as &$record) {
            $worked = WorkingHours::calculateWorkedSeconds(
                $record['time1'], $record['time2'], $record['time3'], $record['time4']
            );
            $record['worked'] = WorkingHours::formatSeconds($worked);
            $totalSeconds += $worked;
        }

        $totalWorked = WorkingHours::formatSeconds($totalSeconds);
        $flash = Session::getFlash();

        require __DIR__ . '/../../views/reports/monthly.php';
    }
}