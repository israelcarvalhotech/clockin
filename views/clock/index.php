<?php $pageTitle = 'Registro de Ponto'; ?>

<div class="card shadow" style="border-radius: 16px;">
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