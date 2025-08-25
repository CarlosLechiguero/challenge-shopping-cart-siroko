FROM php:8.2-fpm-alpine as challenge_php

# Instalar dependencias necesarias para PHP y Symfony
RUN apk add --no-cache \
    git \
    unzip \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    autoconf \
    build-base \
    bash \
    && docker-php-ext-install intl mbstring pdo_mysql zip opcache

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
