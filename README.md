# 🔐 CyberSec Training - Plataforma de Treinamento em Cibersegurança

Uma plataforma web completa para treinamento em cibersegurança com sistema de autenticação e páginas administrativas ocultas para fins educacionais.

## 📋 Características

- **Sistema de Autenticação**: Login seguro com diferentes níveis de acesso
- **Páginas Administrativas Ocultas**: Áreas restritas para treinamento em penetration testing
- **Múltiplos Níveis de Usuário**: Admin, Usuário, Convidado e Super Admin oculto
- **Ferramentas de Segurança**: Simuladores de vulnerabilidades e testes
- **Interface Moderna**: Design responsivo com Tailwind-inspired CSS
- **Logs de Segurança**: Sistema de monitoramento de tentativas de login

## 🚀 Como Usar

### Credenciais de Acesso

#### Usuário Administrador
- **Usuário**: `admin`
- **Senha**: `admin123`
- **Acesso**: Painel completo com todas as ferramentas

#### Usuário Normal
- **Usuário**: `user`
- **Senha**: `password`
- **Acesso**: Módulos de treinamento básico

#### Convidado
- **Usuário**: `guest`
- **Senha**: `guest123`
- **Acesso**: Demonstrações limitadas

#### Super Admin (Oculto)
- **Usuário**: `hidden_admin`
- **Senha**: `secret_pass_2024`
- **Acesso**: Recursos ocultos e backdoors simulados

## 🌐 Como Colocar Online GRATUITAMENTE

### Opção 1: 000webhost (Recomendado)
1. Acesse [000webhost.com](https://www.000webhost.com/)
2. Crie uma conta gratuita
3. Crie um novo website
4. Use o File Manager ou FTP para fazer upload dos arquivos
5. Coloque todos os arquivos na pasta `public_html`
6. Acesse seu site através da URL fornecida

**Vantagens**: Suporte completo a PHP, MySQL gratuito, SSL grátis

### Opção 2: InfinityFree
1. Acesse [infinityfree.net](https://infinityfree.net/)
2. Registre-se gratuitamente
3. Crie uma nova conta de hosting
4. Faça upload via File Manager
5. Coloque os arquivos na pasta `htdocs`

**Vantagens**: Sem anúncios, PHP 8.x, MySQL ilimitado

### Opção 3: Heroku (Para PHP)
1. Instale o Heroku CLI
2. Crie um arquivo `composer.json`:
```json
{
    "require": {
        "php": "^7.4.0"
    }
}
```
3. Crie um arquivo `index.php` que redirecione para `index.html`
4. Deploy via Git:
```bash
git init
git add .
git commit -m "Initial commit"
heroku create seu-app-name
git push heroku main
```

### Opção 4: Netlify + Netlify Functions (Alternativa)
1. Para funcionalidade PHP, use Netlify Functions
2. Converta a lógica PHP para JavaScript/Node.js
3. Deploy direto do GitHub

### Opção 5: GitHub Pages + Simulação
1. Faça fork do repositório
2. Ative GitHub Pages
3. Modifique para usar localStorage em vez de sessões PHP
4. Ideal para demonstrações sem backend real

## 📁 Estrutura de Arquivos

```
cybersec-training/
├── index.html          # Página inicial
├── login.php           # Formulário de login
├── auth.php           # Processamento de autenticação
├── admin.php          # Painel administrativo
├── user_panel.php     # Painel do usuário
├── guest_panel.php    # Área do convidado
├── logout.php         # Logout
├── style.css          # Estilos CSS
├── script.js          # JavaScript
├── logs/              # Diretório de logs (criado automaticamente)
└── README.md          # Este arquivo
```

## 🔧 Configuração Local

### Requisitos
- PHP 7.4 ou superior
- Servidor web (Apache/Nginx) ou XAMPP/WAMP
- Navegador moderno

### Instalação Local
1. Clone ou baixe os arquivos
2. Coloque na pasta do servidor web (`htdocs` para XAMPP)
3. Inicie o servidor
4. Acesse `http://localhost/cybersec-training`

## 🛡️ Recursos de Segurança para Treinamento

### Vulnerabilidades Intencionais (Para Aprendizado)
- **Credenciais Fracas**: Senhas simples para demonstração
- **Informações Expostas**: Dados sensíveis visíveis no código
- **Logs Detalhados**: Informações que podem ser exploradas
- **Backdoor Simulado**: Acesso de emergência para testes

### Ferramentas Incluídas
- **Scanner de Vulnerabilidades**: Simula detecção de falhas
- **Análise de Headers**: Verifica cabeçalhos de segurança
- **Teste de SQL Injection**: Detecta padrões maliciosos
- **Verificador de Senhas**: Analisa força de passwords
- **Análise de URLs**: Identifica links suspeitos

## 📚 Cenários de Treinamento

### Para Iniciantes
1. Teste diferentes credenciais
2. Explore os painéis de usuário
3. Use as ferramentas básicas
4. Analise os logs de acesso

### Para Intermediários
1. Descubra a conta `hidden_admin`
2. Explore o painel administrativo
3. Use as ferramentas de segurança
4. Analise vulnerabilidades intencionais

### Para Avançados
1. Examine o código fonte
2. Identifique falhas de segurança
3. Teste bypass de autenticação
4. Explore o sistema de logs

## ⚠️ Avisos Importantes

- **Uso Educacional**: Esta plataforma é apenas para fins educacionais
- **Não Use em Produção**: Contém vulnerabilidades intencionais
- **Ambiente Controlado**: Use apenas em ambientes de teste
- **Responsabilidade**: Use apenas em sistemas próprios ou autorizados

## 🔄 Atualizações e Melhorias

### Próximas Funcionalidades
- [ ] Sistema de certificados
- [ ] Mais módulos de treinamento
- [ ] Integração com OWASP Top 10
- [ ] Simulador de ataques avançados
- [ ] Dashboard de progresso

### Como Contribuir
1. Faça um fork do projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Abra um Pull Request

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique a documentação
2. Teste em ambiente local primeiro
3. Consulte os logs de erro do servidor
4. Verifique as permissões de arquivo

## 📄 Licença

Este projeto é open source e está disponível sob a licença MIT. Use livremente para fins educacionais.

---

**Desenvolvido para fins educacionais em cibersegurança** 🛡️

*Lembre-se: Com grandes poderes vêm grandes responsabilidades. Use este conhecimento de forma ética e legal.*
