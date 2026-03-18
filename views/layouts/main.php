<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - <?= $pageTitle ?? 'Sistema de Ponto' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #0f3460; }
        .card { border: none; border-radius: 16px; }
        .time-badge {
            font-size: 16px;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-block;
        }
        .btn-punch {
            background: #16a34a;
            border: none;
            padding: 14px 40px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 10px;
        }
        .btn-punch:hover { background: #15803d; }
        .btn-punch:disabled { background: #6b7280; }
        .form-control:focus { border-color: #0f3460; box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25); }
        .total-badge { font-size: 20px; font-weight: 700; color: #0f3460; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <a href="/clock" class="navbar-brand fw-bold text-decoration-none">ClockIn</a>
        <div>
            <a href="/clock" class="btn btn-outline-light btn-sm me-1">Ponto</a>
            <a href="/report" class="btn btn-outline-light btn-sm me-1">Relatório</a>
            <?php if (\App\Core\Session::get('is_admin')): ?>
                <a href="/users" class="btn btn-outline-light btn-sm me-1">Usuários</a>
            <?php endif; ?>
            <span class="text-light me-2"><?= htmlspecialchars($userName) ?></span>
            <a href="/logout" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <?php if (!empty($flash)): ?>
        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <?= $content ?>
</div>
</body>
</html>