<?php
session_start();

// Função para log de tentativas de login (para análise de segurança)
function logLoginAttempt($username, $success, $ip) {
    $logFile = 'logs/login_attempts.log';
    $timestamp = date('Y-m-d H:i:s');
    $status = $success ? 'SUCCESS' : 'FAILED';
    $logEntry = "[$timestamp] $status - User: $username - IP: $ip\n";
    
    // Cria diretório de logs se não existir
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Verifica se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php?error=1");
    exit();
}

// Captura e sanitiza os dados
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$userIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Validação básica
if (empty($username) || empty($password)) {
    logLoginAttempt($username, false, $userIP);
    header("Location: login.php?error=2");
    exit();
}

// Credenciais válidas para treinamento
$validCredentials = [
    'admin' => [
        'password' => 'admin123',
        'role' => 'admin',
        'permissions' => ['admin_panel', 'user_management', 'system_logs', 'security_tools']
    ],
    'user' => [
        'password' => 'password',
        'role' => 'user',
        'permissions' => ['basic_access']
    ],
    'guest' => [
        'password' => 'guest123',
        'role' => 'guest',
        'permissions' => ['limited_access']
    ],
    // Credencial "secreta" para demonstrar descoberta de contas
    'hidden_admin' => [
        'password' => 'secret_pass_2024',
        'role' => 'super_admin',
        'permissions' => ['full_access', 'hidden_features']
    ]
];

// Verificação de credenciais
if (isset($validCredentials[$username]) && 
    $validCredentials[$username]['password'] === $password) {
    
    // Login bem-sucedido
    $userInfo = $validCredentials[$username];
    
    $_SESSION['user'] = $username;
    $_SESSION['role'] = $userInfo['role'];
    $_SESSION['permissions'] = $userInfo['permissions'];
    $_SESSION['login_time'] = time();
    $_SESSION['user_ip'] = $userIP;
    
    // Log da tentativa bem-sucedida
    logLoginAttempt($username, true, $userIP);
    
    // Redireciona baseado no papel do usuário
    switch ($userInfo['role']) {
        case 'admin':
        case 'super_admin':
            header("Location: admin.php");
            break;
        case 'user':
            header("Location: user_panel.php");
            break;
        case 'guest':
            header("Location: guest_panel.php");
            break;
        default:
            header("Location: admin.php");
    }
    exit();
    
} else {
    // Login falhou
    logLoginAttempt($username, false, $userIP);
    
    // Simula delay para dificultar ataques de força bruta
    sleep(1);
    
    header("Location: login.php?error=1");
    exit();
}
?>
