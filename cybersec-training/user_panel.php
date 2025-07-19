<?php
session_start();

// Verificação de autenticação para usuários normais
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['user', 'admin', 'super_admin'])) {
    header("Location: login.php?error=3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário - CyberSec Training</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="user-body">
    <div class="user-container">
        <header class="user-header">
            <div class="header-left">
                <h1>Painel do Usuário</h1>
                <span class="user-welcome">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</span>
            </div>
            <div class="header-right">
                <span class="user-role"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                <a href="logout.php" class="btn btn-secondary">Sair</a>
            </div>
        </header>

        <main class="user-main">
            <div class="user-content">
                <section class="training-modules">
                    <h2>Módulos de Treinamento</h2>
                    <div class="modules-grid">
                        <div class="module-card">
                            <h3>Fundamentos de Segurança</h3>
                            <p>Aprenda os conceitos básicos de cibersegurança</p>
                            <div class="module-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                                <span>75% Completo</span>
                            </div>
                            <button class="btn btn-primary">Continuar</button>
                        </div>

                        <div class="module-card">
                            <h3>Reconhecimento de Phishing</h3>
                            <p>Identifique e evite ataques de phishing</p>
                            <div class="module-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 45%"></div>
                                </div>
                                <span>45% Completo</span>
                            </div>
                            <button class="btn btn-primary">Continuar</button>
                        </div>

                        <div class="module-card locked">
                            <h3>Testes de Penetração</h3>
                            <p>Técnicas básicas de penetration testing</p>
                            <div class="lock-icon">🔒</div>
                            <p class="lock-message">Desbloqueie completando os módulos anteriores</p>
                        </div>
                    </div>
                </section>

                <section class="user-stats">
                    <h2>Suas Estatísticas</h2>
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-icon">📚</div>
                            <div class="stat-info">
                                <h3>Módulos Completados</h3>
                                <span class="stat-number">2/5</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">⏱️</div>
                            <div class="stat-info">
                                <h3>Tempo de Estudo</h3>
                                <span class="stat-number">12h 30m</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">🏆</div>
                            <div class="stat-info">
                                <h3>Pontuação</h3>
                                <span class="stat-number">850</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="recent-activity">
                    <h2>Atividade Recente</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">✅</div>
                            <div class="activity-content">
                                <h4>Módulo "Fundamentos de Segurança" - Lição 3 completada</h4>
                                <span class="activity-time">Há 2 horas</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">📝</div>
                            <div class="activity-content">
                                <h4>Quiz "Identificação de Vulnerabilidades" - 85% de acerto</h4>
                                <span class="activity-time">Ontem</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">🎯</div>
                            <div class="activity-content">
                                <h4>Simulação de Phishing - Detectado com sucesso</h4>
                                <span class="activity-time">2 dias atrás</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Área de teste básica para usuários -->
                <section class="basic-tools">
                    <h2>Ferramentas Básicas</h2>
                    <div class="tools-container">
                        <div class="tool-item">
                            <h3>Verificador de Senhas</h3>
                            <input type="password" id="password-check" placeholder="Digite uma senha para testar">
                            <button class="btn btn-primary" onclick="checkPasswordStrength()">Verificar Força</button>
                            <div id="password-result" class="tool-result"></div>
                        </div>

                        <div class="tool-item">
                            <h3>Simulador de URL Suspeita</h3>
                            <input type="url" id="url-check" placeholder="Digite uma URL para analisar">
                            <button class="btn btn-primary" onclick="checkSuspiciousURL()">Analisar URL</button>
                            <div id="url-result" class="tool-result"></div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
