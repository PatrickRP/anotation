FROM php:8.3-fpm-bullseye

# Dependências do sistema e ODBC
RUN apt-get update && apt-get install -y \
    gnupg2 \
    unixodbc \
    unixodbc-dev \
    curl \
    apt-transport-https \
    lsb-release \
    ca-certificates \
    libssl-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip

# Microsoft ODBC Driver 18 (forma moderna)
RUN curl -sSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > /usr/share/keyrings/microsoft.gpg \
  && echo "deb [arch=amd64 signed-by=/usr/share/keyrings/microsoft.gpg] https://packages.microsoft.com/debian/11/prod bullseye main" > /etc/apt/sources.list.d/mssql-release.list \
  && apt-get update \
  && ACCEPT_EULA=Y apt-get install -y msodbcsql18

# Instala os drivers SQLSRV para PHP
RUN pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Outras extensões PHP necessárias para Laravel
RUN docker-php-ext-install pdo mbstring zip exif pcntl

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório padrão de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto Laravel para o container
COPY . /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Comando padrão do container (inicia o servidor do Laravel)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
