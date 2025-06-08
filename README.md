# 📝 Notes App

Aplicação web desenvolvida em **Laravel 12** com suporte ao **SQL Server** e ambiente de desenvolvimento configurado via **Docker**.

## 🔧 Tecnologias

- [PHP 8.4](https://www.php.net/releases/8.4/)
- [Laravel 12.x](https://laravel.com/docs/12.x)
- [SQL Server 2022](https://hub.docker.com/_/microsoft-mssql-server)
- [Docker](https://www.docker.com/)
- [Blade](https://laravel.com/docs/12.x/blade) (templating)
- [Composer](https://getcomposer.org/)

## 🚀 Funcionalidades

- CRUD de anotações
- Renderização de Markdown
- Relacionamento bidirecional entre anotações
- Backlinks automáticos
- Containerização completa da aplicação e do banco de dados

## 📦 Estrutura de Containers

- **laravel-app**: container da aplicação PHP/Laravel
- **sqlserver**: container do banco de dados Microsoft SQL Server

## 📁 Estrutura de Pastas

```
notes-app/
│
├── app/                  # Código da aplicação Laravel
├── database/             # Migrations e seeders
├── docker-compose.yml    # Orquestração dos containers
├── Dockerfile            # Ambiente PHP com ODBC
├── public/
├── resources/            # Views Blade
├── routes/               # Rotas web
├── .env                  # Configuração de variáveis de ambiente
└── README.md             # Este arquivo
```

## ⚙️ Requisitos

- Docker e Docker Compose instalados
- Git
- Acesso ao GitHub com chave SSH (opcional, mas recomendado)

## 🛠️ Como rodar o projeto

1. Clone o repositório:

   ```bash
   git clone git@github.com:seu-usuario/notes-app.git
   cd notes-app
   ```

2. Crie seu `.env`:

   ```bash
   cp .env.example .env
   ```

3. Suba os containers:

   ```bash
   docker-compose up -d --build
   ```

4. Acesse o container da aplicação:

   ```bash
   docker exec -it laravel-app bash
   ```

5. Instale dependências PHP e gere a chave da aplicação:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate
   ```

6. Acesse via navegador:

   ```
   http://localhost:8000
   ```

## 🔐 Configuração do Banco de Dados

```env
DB_CONNECTION=sqlsrv
DB_HOST=sqlserver
DB_PORT=1433
DB_DATABASE=notes_app
DB_USERNAME=sa
DB_PASSWORD=YourStrong!Passw0rd
```

## 🧪 Testes

No momento, ainda não há testes automatizados implementados. Contribuições são bem-vindas!

## 🐳 Comandos úteis

```bash
# Subir containers
docker-compose up -d

# Parar containers
docker-compose down

# Acessar a aplicação
docker exec -it laravel-app bash

# Rodar migrations
php artisan migrate
```

## 🤝 Contribuindo

Sinta-se à vontade para abrir issues ou enviar pull requests com melhorias ou correções.

## 📝 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
