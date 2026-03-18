<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - Registro de Ponto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #0f3460; }
        .punch-card { border: none; border-radius: 16px; }
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
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">ClockIn</span>
        <div>
            <?php if (\App\Core\Session::get('is_admin')): ?>
                <a href="/users" class="btn btn-outline-light btn-sm me-2">Usuários</a>
            <?php endif; ?>
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

    <div class="card punch-card shadow">
        <div class="card-header text-center py-3">
            <h4 class="mb-0">Registro de Ponto</h4>
            <small class="text-muted"><?= date('d/m/Y') ?></small>
        </div>
        <div class="card-body p-4">
            <div class="row text-center mb-4 g-3">
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block mb-1">Entrada 1</small>
                    <span class="time-badge bg-light"><?= $record['time1'] ?? '---' ?></span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block mb-1">Saída 1</small>
                    <span class="time-badge bg-light"><?= $record['time2'] ?? '---' ?></span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block mb-1">Entrada 2</small>
                    <span class="time-badge bg-light"><?= $record['time3'] ?? '---' ?></span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block mb-1">Saída 2</small>
                    <span class="time-badge bg-light"><?= $record['time4'] ?? '---' ?></span>
                </div>
            </div>
            <div class="text-center">
                <?php if ($nextTime): ?>
                    <form method="POST" action="/clock">
                        <?= \App\Core\Csrf::input() ?>
                        <button type="submit" class="btn btn-punch btn-success text-white">
                            Bater Ponto
                        </button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-punch" disabled>Ponto completo</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>