<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #0f3460; }
        .card { border: none; border-radius: 16px; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">ClockIn</span>
        <div>
            <a href="/clock" class="btn btn-outline-light btn-sm me-2">Ponto</a>
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

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0">Usuários</h4>
            <a href="/users/create" class="btn btn-primary">Novo Usuário</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Admin</th>
                    <th class="text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['name']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= $u['is_admin'] ? 'Sim' : 'Não' ?></td>
                        <td class="text-end">
                            <a href="/users/edit?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <form method="POST" action="/users/delete" class="d-inline" onsubmit="return confirm('Tem certeza?')">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>