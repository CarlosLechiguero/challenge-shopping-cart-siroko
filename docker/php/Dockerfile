FROM php:8.2-fpm-alpine as challenge-php

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --no-cache libmemcached-dev zlib-dev

RUN pecl install memcached \
    && docker-php-ext-enable memcached

RUN docker-php-ext-install mysqli pdo pdo_mysql opcache

RUN apk del -f .build-deps