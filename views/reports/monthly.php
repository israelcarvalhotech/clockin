<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - Relatório Mensal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .navbar { background: #0f3460; }
        .card { border: none; border-radius: 16px; }
        .total-badge {
            font-size: 20px;
            font-weight: 700;
            color: #0f3460;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">ClockIn</span>
        <div>
            <a href="/clock" class="btn btn-outline-light btn-sm me-2">Ponto</a>
            <?php if (\App\Core\Session::get('is_admin')): ?>
                <a href="/users" class="btn btn-outline-light btn-sm me-2">Usuários</a>
            <?php endif; ?>
            <span class="text-light me-3"><?= htmlspecialchars($userName) ?></span>
            <a href="/logout" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="mb-0">Relatório Mensal</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="/report" class="row g-3 align-items-end">
                <div class="col-auto">
                    <label for="month" class="form-label fw-semibold">Mês</label>
                    <select id="month" name="month" class="form-select">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?= $m ?>" <?= $m === $month ? 'selected' : '' ?>>
                                <?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="year" class="form-label fw-semibold">Ano</label>
                    <select id="year" name="year" class="form-select">
                        <?php for ($y = date('Y'); $y >= date('Y') - 2; $y--): ?>
                            <option value="<?= $y ?>" <?= $y === $year ? 'selected' : '' ?>>
                                <?= $y ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Data</th>
                    <th>Entrada 1</th>
                    <th>Saída 1</th>
                    <th>Entrada 2</th>
                    <th>Saída 2</th>
                    <th>Trabalhado</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Nenhum registro encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($records as $r): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($r['work_date'])) ?></td>
                            <td><?= $r['time1'] ?? '---' ?></td>
                            <td><?= $r['time2'] ?? '---' ?></td>
                            <td><?= $r['time3'] ?? '---' ?></td>
                            <td><?= $r['time4'] ?? '---' ?></td>
                            <td><strong><?= $r['worked'] ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <?php if (!empty($records)): ?>
                    <tfoot class="table-light">
                    <tr>
                        <td colspan="5" class="text-end fw-semibold">Total:</td>
                        <td class="total-badge"><?= $totalWorked ?></td>
                    </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>