FROM php:8.2-fpm

# Instala dependências do sistema e extensão pdo_mysql
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

WORKDIR /var/www