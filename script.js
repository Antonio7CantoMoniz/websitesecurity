// Variáveis globais
let currentSection = 'dashboard';

// Inicialização quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

// Função principal de inicialização
function initializeApp() {
    // Inicializar navegação do admin
    initAdminNavigation();
    
    // Inicializar formulários
    initForms();
    
    // Inicializar ferramentas
    initTools();
    
    // Smooth scrolling para links âncora
    initSmoothScrolling();
    
    // Inicializar tooltips e outros elementos interativos
    initInteractiveElements();
}

// Navegação do painel administrativo
function initAdminNavigation() {
    const navItems = document.querySelectorAll('.nav-item[data-section]');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const sectionId = this.getAttribute('data-section');
            showSection(sectionId);
            
            // Atualizar navegação ativa
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

// Mostrar seção específica
function showSection(sectionId) {
    // Esconder todas as seções
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    
    // Mostrar seção selecionada
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.add('active');
        currentSection = sectionId;
        
        // Atualizar título da página
        updatePageTitle(sectionId);
    }
}

// Atualizar título da página
function updatePageTitle(sectionId) {
    const pageTitle = document.getElementById('page-title');
    if (pageTitle) {
        const titles = {
            'dashboard': 'Dashboard',
            'users': 'Gerenciamento de Usuários',
            'logs': 'Logs do Sistema',
            'security': 'Ferramentas de Segurança',
            'hidden': 'Recursos Ocultos'
        };
        pageTitle.textContent = titles[sectionId] || 'Dashboard';
    }
}

// Inicializar formulários
function initForms() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                
                // Simular delay de processamento
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                }, 1000);
            }
        });
    }
}

// Inicializar ferramentas de segurança
function initTools() {
    // Não fazer nada específico aqui, as funções são chamadas pelos botões
}

// Scanner de vulnerabilidades (simulado)
function runVulnScan() {
    const resultsDiv = document.getElementById('vuln-results');
    if (!resultsDiv) return;
    
    resultsDiv.innerHTML = '<div class="loading">Executando scan...</div>';
    
    setTimeout(() => {
        const vulnerabilities = [
            '🔴 CRÍTICO: SQL Injection detectado em /login.php',
            '🟡 MÉDIO: Headers de segurança ausentes',
            '🟡 MÉDIO: Versão do servidor exposta',
            '🟢 BAIXO: Cookies sem flag HttpOnly',
            '🔴 CRÍTICO: Credenciais padrão detectadas'
        ];
        
        let html = '<h4>Resultados do Scan:</h4><ul>';
        vulnerabilities.forEach(vuln => {
            html += `<li>${vuln}</li>`;
        });
        html += '</ul>';
        
        resultsDiv.innerHTML = html;
    }, 2000);
}

// Análise de headers HTTP
function analyzeHeaders() {
    const resultsDiv = document.getElementById('header-results');
    if (!resultsDiv) return;
    
    resultsDiv.innerHTML = '<div class="loading">Analisando headers...</div>';
    
    setTimeout(() => {
        const headers = {
            'X-Frame-Options': '❌ Ausente',
            'X-XSS-Protection': '❌ Ausente',
            'X-Content-Type-Options': '❌ Ausente',
            'Strict-Transport-Security': '❌ Ausente',
            'Content-Security-Policy': '❌ Ausente',
            'Server': '⚠️ Apache/2.4.41 (Versão exposta)'
        };
        
        let html = '<h4>Análise de Headers de Segurança:</h4><ul>';
        Object.entries(headers).forEach(([header, status]) => {
            html += `<li><strong>${header}:</strong> ${status}</li>`;
        });
        html += '</ul>';
        
        resultsDiv.innerHTML = html;
    }, 1500);
}

// Teste de SQL Injection (simulado)
function testSQLInjection() {
    const input = document.getElementById('sql-input');
    const resultsDiv = document.getElementById('sql-results');
    
    if (!input || !resultsDiv) return;
    
    const query = input.value.trim();
    if (!query) {
        resultsDiv.innerHTML = '<div class="error">Digite uma consulta para testar</div>';
        return;
    }
    
    resultsDiv.innerHTML = '<div class="loading">Testando consulta...</div>';
    
    setTimeout(() => {
        // Detectar padrões comuns de SQL injection
        const sqlPatterns = [
            /'/gi,
            /union/gi,
            /select/gi,
            /drop/gi,
            /delete/gi,
            /insert/gi,
            /update/gi,
            /--/gi,
            /\/\*/gi,
            /or\s+1=1/gi,
            /and\s+1=1/gi
        ];
        
        let vulnerabilityFound = false;
        let detectedPatterns = [];
        
        sqlPatterns.forEach(pattern => {
            if (pattern.test(query)) {
                vulnerabilityFound = true;
                detectedPatterns.push(pattern.source);
            }
        });
        
        let html = '<h4>Resultado do Teste:</h4>';
        if (vulnerabilityFound) {
            html += `
                <div class="alert alert-danger">
                    <strong>⚠️ VULNERABILIDADE DETECTADA!</strong><br>
                    Padrões suspeitos encontrados: ${detectedPatterns.join(', ')}<br>
                    Esta consulta pode ser uma tentativa de SQL Injection.
                </div>
            `;
        } else {
            html += `
                <div class="alert alert-success">
                    <strong>✅ CONSULTA SEGURA</strong><br>
                    Nenhum padrão suspeito detectado na consulta.
                </div>
            `;
        }
        
        html += `<div class="query-preview"><strong>Consulta testada:</strong><br><code>${escapeHtml(query)}</code></div>`;
        
        resultsDiv.innerHTML = html;
    }, 1000);
}

// Ativar backdoor (simulado)
function activateBackdoor() {
    const resultsDiv = document.getElementById('backdoor-results');
    if (!resultsDiv) return;
    
    resultsDiv.innerHTML = '<div class="loading">Ativando backdoor...</div>';
    
    setTimeout(() => {
        const html = `
            <div class="alert alert-success">
                <strong>🚪 BACKDOOR ATIVADO!</strong><br>
                Acesso direto ao sistema habilitado.<br>
                <strong>URL de acesso:</strong> <code>/admin/backdoor.php?key=dev_access_2024</code><br>
                <strong>Credenciais temporárias:</strong> <code>backdoor:temp123</code><br>
                <em>⚠️ Esta é apenas uma simulação para fins de treinamento</em>
            </div>
        `;
        resultsDiv.innerHTML = html;
    }, 2000);
}

// Atualizar logs
function refreshLogs() {
    const logsContainer = document.querySelector('.logs-list');
    if (!logsContainer) return;
    
    // Simular carregamento
    logsContainer.innerHTML = '<div class="loading">Atualizando logs...</div>';
    
    setTimeout(() => {
        // Recarregar a página para obter logs atualizados
        window.location.reload();
    }, 1000);
}

// Verificador de força de senha (para usuários)
function checkPasswordStrength() {
    const input = document.getElementById('password-check');
    const resultDiv = document.getElementById('password-result');
    
    if (!input || !resultDiv) return;
    
    const password = input.value;
    if (!password) {
        resultDiv.innerHTML = '<div class="error">Digite uma senha para verificar</div>';
        return;
    }
    
    const strength = calculatePasswordStrength(password);
    const strengthText = ['Muito Fraca', 'Fraca', 'Média', 'Forte', 'Muito Forte'];
    const strengthColors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#16a34a'];
    
    let html = `
        <div class="password-strength">
            <h4>Análise da Senha:</h4>
            <div class="strength-indicator" style="background-color: ${strengthColors[strength]}">
                ${strengthText[strength]}
            </div>
            <div class="strength-details">
                <p>Comprimento: ${password.length} caracteres</p>
                <p>Contém maiúsculas: ${/[A-Z]/.test(password) ? '✅' : '❌'}</p>
                <p>Contém minúsculas: ${/[a-z]/.test(password) ? '✅' : '❌'}</p>
                <p>Contém números: ${/[0-9]/.test(password) ? '✅' : '❌'}</p>
                <p>Contém símbolos: ${/[^A-Za-z0-9]/.test(password) ? '✅' : '❌'}</p>
            </div>
        </div>
    `;
    
    resultDiv.innerHTML = html;
}

// Calcular força da senha
function calculatePasswordStrength(password) {
    let score = 0;
    
    // Comprimento
    if (password.length >= 8) score++;
    if (password.length >= 12) score++;
    
    // Complexidade
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^A-Za-z0-9]/.test(password)) score++;
    
    // Penalizar padrões comuns
    if (/123|abc|password|admin/i.test(password)) score--;
    
    return Math.max(0, Math.min(4, score - 1));
}

// Verificar URL suspeita
function checkSuspiciousURL() {
    const input = document.getElementById('url-check');
    const resultDiv = document.getElementById('url-result');
    
    if (!input || !resultDiv) return;
    
    const url = input.value.trim();
    if (!url) {
        resultDiv.innerHTML = '<div class="error">Digite uma URL para analisar</div>';
        return;
    }
    
    const suspiciousPatterns = [
        { pattern: /bit\.ly|tinyurl|t\.co/i, risk: 'Médio', reason: 'URL encurtada' },
        { pattern: /[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/i, risk: 'Alto', reason: 'IP direto em vez de domínio' },
        { pattern: /[a-z0-9]{20,}/i, risk: 'Médio', reason: 'String aleatória longa' },
        { pattern: /paypal|amazon|google|microsoft/i, risk: 'Alto', reason: 'Possível phishing de marca conhecida' },
        { pattern: /urgent|verify|suspend|click/i, risk: 'Médio', reason: 'Palavras comuns em phishing' }
    ];
    
    let riskLevel = 'Baixo';
    let detectedIssues = [];
    
    suspiciousPatterns.forEach(item => {
        if (item.pattern.test(url)) {
            detectedIssues.push(`${item.reason} (Risco: ${item.risk})`);
            if (item.risk === 'Alto') riskLevel = 'Alto';
            else if (item.risk === 'Médio' && riskLevel !== 'Alto') riskLevel = 'Médio';
        }
    });
    
    const riskColors = {
        'Baixo': '#22c55e',
        'Médio': '#f59e0b',
        'Alto': '#ef4444'
    };
    
    let html = `
        <div class="url-analysis">
            <h4>Análise da URL:</h4>
            <div class="risk-level" style="color: ${riskColors[riskLevel]}">
                <strong>Nível de Risco: ${riskLevel}</strong>
            </div>
    `;
    
    if (detectedIssues.length > 0) {
        html += '<div class="detected-issues"><h5>Problemas Detectados:</h5><ul>';
        detectedIssues.forEach(issue => {
            html += `<li>${issue}</li>`;
        });
        html += '</ul></div>';
    } else {
        html += '<p>✅ Nenhum problema óbvio detectado</p>';
    }
    
    html += `<div class="url-preview"><strong>URL analisada:</strong><br><code>${escapeHtml(url)}</code></div></div>`;
    
    resultDiv.innerHTML = html;
}

// Verificador simples de senha para convidados
function simplePasswordCheck() {
    const input = document.getElementById('guest-password');
    const resultDiv = document.getElementById('guest-password-result');
    
    if (!input || !resultDiv) return;
    
    const password = input.value;
    if (!password) {
        resultDiv.innerHTML = '<div class="error">Digite uma senha</div>';
        return;
    }
    
    let score = 0;
    let feedback = [];
    
    if (password.length >= 8) {
        score += 2;
        feedback.push('✅ Comprimento adequado');
    } else {
        feedback.push('❌ Muito curta (mínimo 8 caracteres)');
    }
    
    if (/[A-Z]/.test(password) && /[a-z]/.test(password)) {
        score += 1;
        feedback.push('✅ Contém maiúsculas e minúsculas');
    } else {
        feedback.push('❌ Precisa de maiúsculas e minúsculas');
    }
    
    if (/[0-9]/.test(password)) {
        score += 1;
        feedback.push('✅ Contém números');
    } else {
        feedback.push('❌ Precisa de números');
    }
    
    const strength = score >= 3 ? 'Boa' : score >= 2 ? 'Média' : 'Fraca';
    const color = score >= 3 ? '#22c55e' : score >= 2 ? '#f59e0b' : '#ef4444';
    
    let html = `
        <div style="color: ${color}"><strong>Força: ${strength}</strong></div>
        <ul>
    `;
    
    feedback.forEach(item => {
        html += `<li>${item}</li>`;
    });
    
    html += '</ul>';
    resultDiv.innerHTML = html;
}

// Verificar HTTPS para convidados
function checkHTTPS() {
    const input = document.getElementById('guest-url');
    const resultDiv = document.getElementById('guest-url-result');
    
    if (!input || !resultDiv) return;
    
    const url = input.value.trim();
    if (!url) {
        resultDiv.innerHTML = '<div class="error">Digite uma URL</div>';
        return;
    }
    
    const isHTTPS = url.toLowerCase().startsWith('https://');
    const isHTTP = url.toLowerCase().startsWith('http://');
    
    let html = '';
    
    if (isHTTPS) {
        html = `
            <div style="color: #22c55e">
                <strong>✅ SEGURO</strong><br>
                Esta URL usa HTTPS (conexão criptografada)
            </div>
        `;
    } else if (isHTTP) {
        html = `
            <div style="color: #ef4444">
                <strong>⚠️ INSEGURO</strong><br>
                Esta URL usa HTTP (conexão não criptografada)
            </div>
        `;
    } else {
        html = `
            <div style="color: #f59e0b">
                <strong>❓ FORMATO INVÁLIDO</strong><br>
                URL deve começar com http:// ou https://
            </div>
        `;
    }
    
    resultDiv.innerHTML = html;
}

// Smooth scrolling para links âncora
function initSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Inicializar elementos interativos
function initInteractiveElements() {
    // Adicionar efeitos hover aos cards
    const cards = document.querySelectorAll('.card, .module-card, .tool-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Auto-hide de mensagens de erro após 5 segundos
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.opacity = '0';
            setTimeout(() => {
                msg.style.display = 'none';
            }, 300);
        }, 5000);
    });
}

// Função utilitária para escapar HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Função para mostrar notificações
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Estilos inline para a notificação
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        color: white;
        font-weight: 500;
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
    `;
    
    // Cores baseadas no tipo
    const colors = {
        'info': '#3b82f6',
        'success': '#10b981',
        'warning': '#f59e0b',
        'error': '#ef4444'
    };
    
    notification.style.backgroundColor = colors[type] || colors.info;
    
    document.body.appendChild(notification);
    
    // Remover após 3 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Adicionar estilos de animação para notificações
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .loading {
        color: #6b7280;
        font-style: italic;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 0.375rem;
        margin: 1rem 0;
    }
    
    .alert-success {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }
    
    .alert-danger {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    
    .query-preview {
        margin-top: 1rem;
        padding: 1rem;
        background-color: #f8fafc;
        border-radius: 0.25rem;
        border: 1px solid #e2e8f0;
    }
    
    .query-preview code {
        background-color: #e2e8f0;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-family: 'Courier New', monospace;
    }
`;

document.head.appendChild(style);

// Função para debug (remover em produção)
function debugLog(message) {
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        console.log('[CyberSec Training Debug]:', message);
    }
}

// Log de inicialização
debugLog('Script carregado e inicializado com sucesso');
