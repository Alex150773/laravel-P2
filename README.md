# Laravel-P2

Sistema de gestão de categorias desenvolvido em Laravel 10 com Docker.

## 🚀 Quick Start

### Pré-requisitos
- Docker
- Docker Compose

### Iniciar o projeto

```bash
# Navegue até o diretório do projeto
cd /workspaces/Prova-p2-Laravel

# Inicie os containers (app, db, phpmyadmin)
docker-compose up -d

# Aguarde ~15 segundos para o aplicativo estar pronto
```

A aplicação estará disponível em:
- **Local:** http://localhost:8080/categorias
- **Preview:** https://SEU_HOST-8080.app.github.dev/categorias

> **Atenção:** Sempre acesse o caminho `/categorias` após a porta no preview. A raiz `/` pode mostrar "Not Found" ou não redirecionar corretamente.

PHPMyAdmin estará disponível em:
- **Local:** http://localhost:8081/
- **Codespaces/Preview:** https://seu-host-8081.app.github.dev/

## 📋 Serviços

A aplicação executa em 3 containers Docker:

| Serviço | Porta Host | Descrição |
|---------|-----------|-----------|
| **Laravel App** | 8080 | Aplicação PHP-FPM com Nginx (Acesso HTTP/HTTPS) |
| **MySQL** | Interno | Banco de dados (apenas acesso interno via container network) |
| **PHPMyAdmin** | 8081 | Interface web de gerenciamento do banco (Acesso HTTP/HTTPS) |

> **Nota:** A porta 3306 (MySQL) não é exposta para o host por segurança. Acesse o banco via phpMyAdmin (porta 8081).

## 🎯 Funcionalidades

### CRUD de Categorias

- **Listar** - GET `/categorias` - Exibe todas as categorias
- **Criar** - GET `/categorias/create` → POST `/categorias` - Formulário para nova categoria
- **Editar** - GET `/categorias/{id}/edit` → PUT `/categorias/{id}` - Modificar categoria existente
- **Deletar** - DELETE `/categorias/{id}` - Remover categoria
- **Visualizar** - GET `/categorias/{id}` - Detalhes de uma categoria

Rotas implementadas usando `Route::resource()` para padrão RESTful completo.

## 🗄️ Banco de Dados

### Tabela: `categorias`

```sql
CREATE TABLE categorias (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  descricao TEXT,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**Acesso ao banco:**
- Host: `mysql` (interno) ou `localhost:3306` (externo)
- User: `laravel`
- Password: `laravel`
- Database: `laravel_db`

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── CategoriaController.php    # CRUD Controller
│   │   └── Middleware/
│   │       └── VerifyCsrfToken.php       # CSRF Protection
│   ├── Models/
│   │   └── Categoria.php                 # Eloquent Model
│   └── Providers/
│       └── RouteServiceProvider.php      # Route loading
├── routes/
│   ├── web.php                           # HTTP Routes
│   └── api.php                           # API Routes
├── database/
│   └── migrations/
│       └── 2024_11_23_000000_create_categorias_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Main layout
│       └── categorias/
│           ├── index.blade.php          # List view
│           ├── create.blade.php         # Create form
│           └── edit.blade.php           # Edit form
├── config/
│   ├── app.php                          # Application config
│   ├── database.php                     # Database config
│   ├── view.php                         # View compiler config
│   └── session.php                      # Session driver config
├── docker-compose.yml                   # Docker services
├── Dockerfile                           # PHP-FPM image
└── .env                                 # Environment variables
```

## 🔧 Tecnologias

- **Laravel** 10.49.1
- **PHP** 8.2-FPM
- **MySQL** 8.0
- **Nginx** Web Server
- **Docker** + Docker Compose
- **Blade** Template Engine
- **Eloquent** ORM

## ✅ Verificação

Todos os requisitos foram verificados e estão funcionando:

```
✅ GET /categorias: HTTP 200 OK
✅ MySQL connection: Conectado e respondendo
✅ Migrations: Executadas com sucesso
✅ View rendering: Templates Blade renderizando
✅ Eloquent Model: Categoria.php presente
✅ Controller: CategoriaController.php funcional
✅ RESTful Routes: Route::resource() implementado
✅ Docker Config: Containers rodando e saudáveis
```

## 🛑 Parar a aplicação

```bash
docker-compose down
```

---

## 🔍 Diagnóstico de Portas e Acessos

### ✅ Portas Ativas

| Serviço | Porta | Tipo | Descrição |
|---------|-------|------|-----------|
| Laravel App | 8080 | HTTP/HTTPS | Aplicação web - acesse aqui |
| phpMyAdmin | 8081 | HTTP/HTTPS | Gerenciador MySQL - acesse aqui |
| MySQL | Interno | TCP | Apenas via container network (segurança) |

### ❌ Porta 3306 (MySQL)

- **NÃO está exposta** para o host (acesso externo bloqueado por segurança)
- **Como acessar o banco:** Use phpMyAdmin na porta 8081
- **Credenciais MySQL:**
  - Usuário: `laravel_user`
  - Senha: `laravel_password`
  - Banco: `laravel_db`

### ✅ Acessos Corretos (Local)

```bash
# Laravel App
curl http://localhost:8080/categorias

# phpMyAdmin
curl http://localhost:8081/

# MySQL (via Docker)
docker-compose exec db mysql -u laravel_user -plaravel_password laravel_db
```

### ✅ Acessos no Codespaces/Preview (GitHub.dev)

- **Laravel:** `https://seu-host-8080.app.github.dev/`
- **phpMyAdmin:** `https://seu-host-8081.app.github.dev/`
- **MySQL:** Indisponível externamente (use phpMyAdmin em vez disso)

## 📝 Variáveis de Ambiente

O arquivo `.env` contém as configurações:

```env
APP_NAME=Laravel
APP_ENV=local
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel
DB_PASSWORD=laravel
SESSION_DRIVER=file
```

## 📞 Suporte

Para mais informações sobre Laravel: https://laravel.com/docs

---

**Status**: ✅ Projeto completo e funcional | **Versão**: 1.0 | **Data**: Nov 2024
