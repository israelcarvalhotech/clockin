<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\Csrf;
use App\Core\Validator;
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
        if (!Csrf::verify()) {
            Session::setFlash('error', 'Token de segurança inválido.');
            header('Location: /login');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $validator = new Validator();
        $validator
            ->required('email', $email, 'E-mail')
            ->required('password', $password, 'Senha');

        if ($validator->hasErrors()) {
            Session::setFlash('error', $validator->getFirstError());
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

        header('Location: /clock');
        exit;
    }

    public function logout(): void
    {
        Session::destroy();
        header('Location: /login');
        exit;
    }
}