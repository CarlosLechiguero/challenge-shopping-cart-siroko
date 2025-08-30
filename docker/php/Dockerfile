FROM php:8.2-fpm-alpine as challenge-php

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN docker-php-ext-install mysqli pdo pdo_mysql opcache