<?php
session_start();

// Verificação de autenticação
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    header("Location: login.php?error=3");
    exit();
}

// Função para verificar permissões
function hasPermission($permission) {
    return isset($_SESSION['permissions']) && in_array($permission, $_SESSION['permissions']);
}

// Função para obter logs de login
function getLoginLogs($limit = 50) {
    $logFile = 'logs/login_attempts.log';
    if (!file_exists($logFile)) {
        return [];
    }
    
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_slice(array_reverse($logs), 0, $limit);
}

$loginLogs = getLoginLogs(20);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - CyberSec Training</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
                <div class="user-info">
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <span class="user-role"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#dashboard" class="nav-item active" data-section="dashboard">
                    <span class="nav-icon">📊</span>
                    Dashboard
                </a>
                
                <?php if (hasPermission('user_management')): ?>
                <a href="#users" class="nav-item" data-section="users">
                    <span class="nav-icon">👥</span>
                    Usuários
                </a>
                <?php endif; ?>
                
                <?php if (hasPermission('system_logs')): ?>
                <a href="#logs" class="nav-item" data-section="logs">
                    <span class="nav-icon">📋</span>
                    Logs do Sistema
                </a>
                <?php endif; ?>
                
                <?php if (hasPermission('security_tools')): ?>
                <a href="#security" class="nav-item" data-section="security">
                    <span class="nav-icon">🔒</span>
                    Ferramentas de Segurança
                </a>
                <?php endif; ?>
                
                <?php if (hasPermission('hidden_features')): ?>
                <a href="#hidden" class="nav-item" data-section="hidden">
                    <span class="nav-icon">🕵️</span>
                    Recursos Ocultos
                </a>
                <?php endif; ?>
                
                <a href="logout.php" class="nav-item logout">
                    <span class="nav-icon">🚪</span>
                    Sair
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="content-header">
                <h1 id="page-title">Dashboard</h1>
                <div class="header-actions">
                    <span class="session-info">
                        IP: <?php echo htmlspecialchars($_SESSION['user_ip'] ?? 'N/A'); ?> | 
                        Login: <?php echo date('H:i:s', $_SESSION['login_time']); ?>
                    </span>
                </div>
            </header>

            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section active">
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Usuários Ativos</h3>
                        <div class="stat-number">4</div>
                        <p>Contas disponíveis no sistema</p>
                    </div>
                    <div class="stat-card">
                        <h3>Tentativas de Login</h3>
                        <div class="stat-number"><?php echo count($loginLogs); ?></div>
                        <p>Registros de acesso hoje</p>
                    </div>
                    <div class="stat-card">
                        <h3>Nível de Acesso</h3>
                        <div class="stat-number"><?php echo $_SESSION['role']; ?></div>
                        <p>Seu nível atual</p>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="welcome-message">
                        <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
                        <p>Este é o painel administrativo da plataforma de treinamento em cibersegurança. 
                           Aqui você pode gerenciar usuários, visualizar logs e acessar ferramentas de segurança.</p>
                    </div>

                    <div class="quick-actions">
                        <h3>Ações Rápidas</h3>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="showSection('logs')">Ver Logs</button>
                            <button class="btn btn-secondary" onclick="showSection('security')">Ferramentas</button>
                            <?php if (hasPermission('hidden_features')): ?>
                            <button class="btn btn-danger" onclick="showSection('hidden')">Área Secreta</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Users Section -->
            <?php if (hasPermission('user_management')): ?>
            <section id="users" class="content-section">
                <div class="section-header">
                    <h2>Gerenciamento de Usuários</h2>
                </div>
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Papel</th>
                                <th>Permissões</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>admin</td>
                                <td>Administrador</td>
                                <td>Completas</td>
                                <td><span class="status active">Ativo</span></td>
                            </tr>
                            <tr>
                                <td>user</td>
                                <td>Usuário</td>
                                <td>Básicas</td>
                                <td><span class="status active">Ativo</span></td>
                            </tr>
                            <tr>
                                <td>guest</td>
                                <td>Convidado</td>
                                <td>Limitadas</td>
                                <td><span class="status active">Ativo</span></td>
                            </tr>
                            <tr>
                                <td>hidden_admin</td>
                                <td>Super Admin</td>
                                <td>Todas + Ocultas</td>
                                <td><span class="status hidden">Oculto</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <?php endif; ?>

            <!-- Logs Section -->
            <?php if (hasPermission('system_logs')): ?>
            <section id="logs" class="content-section">
                <div class="section-header">
                    <h2>Logs do Sistema</h2>
                    <button class="btn btn-secondary" onclick="refreshLogs()">Atualizar</button>
                </div>
                <div class="logs-container">
                    <?php if (empty($loginLogs)): ?>
                        <p>Nenhum log encontrado.</p>
                    <?php else: ?>
                        <div class="logs-list">
                            <?php foreach ($loginLogs as $log): ?>
                                <div class="log-entry <?php echo strpos($log, 'SUCCESS') !== false ? 'success' : 'failed'; ?>">
                                    <?php echo htmlspecialchars($log); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- Security Tools Section -->
            <?php if (hasPermission('security_tools')): ?>
            <section id="security" class="content-section">
                <div class="section-header">
                    <h2>Ferramentas de Segurança</h2>
                </div>
                <div class="tools-grid">
                    <div class="tool-card">
                        <h3>Scanner de Vulnerabilidades</h3>
                        <p>Simula um scanner básico de vulnerabilidades web</p>
                        <button class="btn btn-primary" onclick="runVulnScan()">Executar Scan</button>
                        <div id="vuln-results" class="tool-results"></div>
                    </div>
                    <div class="tool-card">
                        <h3>Análise de Headers</h3>
                        <p>Verifica headers de segurança HTTP</p>
                        <button class="btn btn-primary" onclick="analyzeHeaders()">Analisar Headers</button>
                        <div id="header-results" class="tool-results"></div>
                    </div>
                    <div class="tool-card">
                        <h3>Teste de SQL Injection</h3>
                        <p>Área de teste para SQL injection (simulado)</p>
                        <input type="text" id="sql-input" placeholder="Digite uma consulta...">
                        <button class="btn btn-warning" onclick="testSQLInjection()">Testar</button>
                        <div id="sql-results" class="tool-results"></div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <!-- Hidden Features Section -->
            <?php if (hasPermission('hidden_features')): ?>
            <section id="hidden" class="content-section">
                <div class="section-header">
                    <h2>🕵️ Recursos Ocultos</h2>
                    <p class="warning">⚠️ Esta seção só é visível para super administradores</p>
                </div>
                <div class="hidden-content">
                    <div class="secret-info">
                        <h3>Informações Confidenciais</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <strong>Chave API Secreta:</strong>
                                <code>sk_live_51234567890abcdef</code>
                            </div>
                            <div class="info-item">
                                <strong>Servidor de Backup:</strong>
                                <code>backup.internal.company.com</code>
                            </div>
                            <div class="info-item">
                                <strong>Credenciais de Emergência:</strong>
                                <code>emergency_user:temp_pass_2024!</code>
                            </div>
                        </div>
                    </div>
                    
                    <div class="backdoor-section">
                        <h3>🚪 Backdoor de Desenvolvimento</h3>
                        <p>Esta funcionalidade permite acesso direto ao sistema (apenas para demonstração)</p>
                        <button class="btn btn-danger" onclick="activateBackdoor()">Ativar Backdoor</button>
                        <div id="backdoor-results" class="tool-results"></div>
                    </div>
                </div>
            </section>
            <?php endif; ?>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
