<?php
session_start();

// Verificação de autenticação para convidados
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['guest', 'user', 'admin', 'super_admin'])) {
    header("Location: login.php?error=3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Convidado - CyberSec Training</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="guest-body">
    <div class="guest-container">
        <header class="guest-header">
            <div class="header-content">
                <h1>Área do Convidado</h1>
                <div class="guest-info">
                    <span>Olá, <?php echo htmlspecialchars($_SESSION['user']); ?>!</span>
                    <a href="logout.php" class="btn btn-outline">Sair</a>
                </div>
            </div>
        </header>

        <main class="guest-main">
            <div class="welcome-section">
                <h2>Bem-vindo à Demonstração</h2>
                <p>Como convidado, você tem acesso limitado à plataforma. Explore os recursos básicos abaixo:</p>
            </div>

            <div class="demo-content">
                <section class="demo-modules">
                    <h3>Módulos de Demonstração</h3>
                    <div class="demo-grid">
                        <div class="demo-card">
                            <h4>Introdução à Cibersegurança</h4>
                            <p>Conceitos básicos e importância da segurança digital</p>
                            <span class="demo-badge">Gratuito</span>
                            <button class="btn btn-primary">Ver Demonstração</button>
                        </div>

                        <div class="demo-card">
                            <h4>Reconhecimento de Ameaças</h4>
                            <p>Como identificar tentativas de ataques comuns</p>
                            <span class="demo-badge">Gratuito</span>
                            <button class="btn btn-primary">Ver Demonstração</button>
                        </div>

                        <div class="demo-card locked">
                            <h4>Testes Práticos</h4>
                            <p>Simulações e exercícios hands-on</p>
                            <span class="demo-badge premium">Premium</span>
                            <button class="btn btn-disabled" disabled>Requer Upgrade</button>
                        </div>
                    </div>
                </section>

                <section class="basic-info">
                    <h3>Informações Básicas de Segurança</h3>
                    <div class="info-cards">
                        <div class="info-card">
                            <div class="info-icon">🔐</div>
                            <h4>Senhas Seguras</h4>
                            <ul>
                                <li>Use pelo menos 12 caracteres</li>
                                <li>Combine letras, números e símbolos</li>
                                <li>Evite informações pessoais</li>
                                <li>Use um gerenciador de senhas</li>
                            </ul>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">📧</div>
                            <h4>Identificar Phishing</h4>
                            <ul>
                                <li>Verifique o remetente cuidadosamente</li>
                                <li>Desconfie de urgência excessiva</li>
                                <li>Não clique em links suspeitos</li>
                                <li>Confirme por outro canal</li>
                            </ul>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">🛡️</div>
                            <h4>Navegação Segura</h4>
                            <ul>
                                <li>Verifique se o site usa HTTPS</li>
                                <li>Mantenha o navegador atualizado</li>
                                <li>Use extensões de segurança</li>
                                <li>Evite downloads suspeitos</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="simple-tools">
                    <h3>Ferramentas Básicas</h3>
                    <div class="tools-demo">
                        <div class="tool-demo">
                            <h4>Teste de Senha Simples</h4>
                            <input type="password" id="guest-password" placeholder="Digite uma senha">
                            <button class="btn btn-secondary" onclick="simplePasswordCheck()">Testar</button>
                            <div id="guest-password-result" class="result-area"></div>
                        </div>

                        <div class="tool-demo">
                            <h4>Verificador de HTTPS</h4>
                            <input type="url" id="guest-url" placeholder="Digite uma URL">
                            <button class="btn btn-secondary" onclick="checkHTTPS()">Verificar</button>
                            <div id="guest-url-result" class="result-area"></div>
                        </div>
                    </div>
                </section>

                <section class="upgrade-section">
                    <div class="upgrade-card">
                        <h3>Quer Acesso Completo?</h3>
                        <p>Upgrade sua conta para acessar todos os módulos, ferramentas avançadas e simulações práticas.</p>
                        <div class="upgrade-features">
                            <div class="feature">✅ Todos os módulos de treinamento</div>
                            <div class="feature">✅ Simulações práticas</div>
                            <div class="feature">✅ Ferramentas avançadas</div>
                            <div class="feature">✅ Certificados de conclusão</div>
                        </div>
                        <button class="btn btn-primary btn-large">Fazer Upgrade</button>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
