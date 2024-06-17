# Usar a imagem oficial do PHP
FROM php:8.1-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instalar extensões PHP
RUN docker-php-ext-install -j$(nproc) pdo_mysql mbstring zip exif pcntl bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto
COPY . .

# Instalar dependências do Composer
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

# Configurar permissões
RUN chown -R www-data:www-data /var/www

# Ajustar proprietário e grupo para www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Ajustar permissões de leitura, escrita e execução
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache


# Otimizar a aplicação Laravel
RUN php artisan optimize

# Expor a porta
EXPOSE 9000

# Comando de inicialização
CMD ["php-fpm"]
