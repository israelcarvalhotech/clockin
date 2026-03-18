<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - <?= empty($user) ? 'Novo Usuário' : 'Editar Usuário' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #0f3460; }
        .card { border: none; border-radius: 16px; }
        .form-control:focus { border-color: #0f3460; box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25); }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">ClockIn</span>
        <div>
            <a href="/users" class="btn btn-outline-light btn-sm me-2">Voltar</a>
            <span class="text-light me-3"><?= htmlspecialchars($userName) ?></span>
            <a href="/logout" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="mb-0"><?= empty($user) ? 'Novo Usuário' : 'Editar Usuário' ?></h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= empty($user) ? '/users/store' : '/users/update' ?>">
                        <?= \App\Core\Csrf::input() ?>
                        <?php if (!empty($user)): ?>
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nome</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                Senha <?= !empty($user) ? '(deixe vazio para manter)' : '' ?>
                            </label>
                            <input type="password" id="password" name="password" class="form-control"
                                    <?= empty($user) ? 'required' : '' ?>>
                        </div>
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input"
                                        <?= !empty($user['is_admin']) ? 'checked' : '' ?>>
                                <label for="is_admin" class="form-check-label">Administrador</label>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="/users" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>