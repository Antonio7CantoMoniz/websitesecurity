<?php
session_start();

// Log da ação de logout
if (isset($_SESSION['user'])) {
    $logFile = 'logs/login_attempts.log';
    $timestamp = date('Y-m-d H:i:s');
    $username = $_SESSION['user'];
    $userIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $logEntry = "[$timestamp] LOGOUT - User: $username - IP: $userIP\n";
    
    // Cria diretório de logs se não existir
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Destroi a sessão
session_destroy();

// Remove cookies de sessão se existirem
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Redireciona para a página inicial
header("Location: index.html");
exit();
?>
