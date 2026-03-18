<?php

namespace App\Controllers;

use App\Core\Session;
use App\Models\User;

class UserController
{
    private function requireAdmin(): void
    {
        if (!Session::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        if (!Session::get('is_admin')) {
            Session::setFlash('error', 'Acesso negado!');
            header('Location: /clock');
            exit;
        }
    }

    public function index(): void
    {
        $this->requireAdmin();
        $users = User::getAll();
        $flash = Session::getFlash();
        $userName = Session::get('user_name');
        require __DIR__ . '/../../views/users/index.php';
    }

    public function create(): void
    {
        $this->requireAdmin();
        $user = [];
        $flash = Session::getFlash();
        $userName = Session::get('user_name');
        require __DIR__ . '/../../views/users/form.php';
    }

    public function store(): void
    {
        $this->requireAdmin();

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

        if (empty($name) || empty($email) || empty($password)) {
            Session::setFlash('error', 'Preencha todos os campos obrigatórios.');
            header('Location: /users/create');
            exit;
        }

        if (User::findByEmail($email)) {
            Session::setFlash('error', 'Este e-mail já está cadastrado.');
            header('Location: /users/create');
            exit;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => $isAdmin,
        ]);

        Session::setFlash('success', 'Usuário cadastrado com sucesso!');
        header('Location: /users');
        exit;
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /users');
            exit;
        }

        $user = User::findById((int) $id);
        if (!$user) {
            Session::setFlash('error', 'Usuário não encontrado.');
            header('Location: /users');
            exit;
        }

        $flash = Session::getFlash();
        $userName = Session::get('user_name');
        require __DIR__ . '/../../views/users/form.php';
    }

    public function update(): void
    {
        $this->requireAdmin();
        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: /users');
            exit;
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

        if (empty($name) || empty($email)) {
            Session::setFlash('error', 'Nome e e-mail são obrigatórios.');
            header("Location: /users/edit?id={$id}");
            exit;
        }

        User::update((int) $id, [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => $isAdmin,
        ]);

        Session::setFlash('success', 'Usuário atualizado com sucesso!');
        header('Location: /users');
        exit;
    }

    public function destroy(): void
    {
        $this->requireAdmin();
        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: /users');
            exit;
        }

        User::delete((int) $id);
        Session::setFlash('success', 'Usuário excluído com sucesso!');
        header('Location: /users');
        exit;
    }
}