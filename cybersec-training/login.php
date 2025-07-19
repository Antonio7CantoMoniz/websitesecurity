<?php
session_start();

// Se já estiver logado, redireciona para admin
if (isset($_SESSION['user'])) {
    header("Location: admin.php");
    exit();
}

$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case '1':
            $error = 'Credenciais inválidas!';
            break;
        case '2':
            $error = 'Todos os campos são obrigatórios!';
            break;
        case '3':
            $error = 'Sessão expirada. Faça login novamente.';
            break;
        default:
            $error = 'Erro desconhecido.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CyberSec Training</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>CyberSec Training</h1>
                <h2>Acesso ao Sistema</h2>
            </div>

            <?php if ($error): ?>
                <div class="error-message">
                    <span class="error-icon">⚠️</span>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="auth.php" method="POST" class="login-form" id="loginForm">
                <div class="form-group">
                    <label for="username">Usuário</label>
                    <input type="text" id="username" name="username" required 
                           placeholder="Digite seu usuário" autocomplete="username">
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Digite sua senha" autocomplete="current-password">
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    <span class="btn-text">Entrar</span>
                    <span class="btn-loading" style="display: none;">Entrando...</span>
                </button>
            </form>

            <div class="login-footer">
                <p><a href="index.html" class="link">← Voltar ao início</a></p>
                
                <!-- Dicas para treinamento -->
                <div class="training-hints">
                    <h4>💡 Dicas para Treinamento:</h4>
                    <div class="hint-item">
                        <strong>Usuário Admin:</strong> admin
                    </div>
                    <div class="hint-item">
                        <strong>Senha Admin:</strong> admin123
                    </div>
                    <div class="hint-item">
                        <strong>Usuário Teste:</strong> user
                    </div>
                    <div class="hint-item">
                        <strong>Senha Teste:</strong> password
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
