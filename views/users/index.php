<?php $pageTitle = 'Usuários'; ?>

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
                            <?= \App\Core\Csrf::input() ?>
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