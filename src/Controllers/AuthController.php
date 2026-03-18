<?php

namespace App\Controllers;

use App\Core\Session;
use App\Models\User;

class AuthController
{
    public function showLogin(): void
    {
        $flash = Session::getFlash();
        require __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Session::setFlash('error', 'Preencha todos os campos.');
            header('Location: /login');
            exit;
        }

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Session::setFlash('error', 'Email ou senha inválidos.');
            header('Location: /login');
            exit;
        }

        Session::set('user_id', $user['id']);
        Session::set('user_name', $user['name']);
        Session::set('is_admin', $user['is_admin']);

        header('Location: /');
        exit;
    }

    public function logout(): void
    {
        Session::destroy();
        header('Location: /login');
        exit;
    }
}