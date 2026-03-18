<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClockIn - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }
        .login-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }
        .login-header {
            background: #0f3460;
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .login-header h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .login-header small {
            opacity: 0.7;
        }
        .login-body {
            padding: 32px 24px;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25);
        }
        .btn-primary {
            background: #0f3460;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
        }
        .btn-primary:hover {
            background: #1a4a7a;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card shadow-lg">
                <div class="login-header">
                    <h3>ClockIn</h3>
                    <small>Sistema de controle de ponto</small>
                </div>
                <div class="login-body">
                    <?php if ($flash): ?>
                        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?> py-2">
                            <?= htmlspecialchars($flash['message']) ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="seu@email.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Senha</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Sua senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>