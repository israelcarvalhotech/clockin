<?php $pageTitle = 'Relatório Mensal'; ?>

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