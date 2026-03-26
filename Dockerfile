FROM php:8.2-cli-alpine

RUN apk add --no-cache git unzip libxml2-dev oniguruma-dev libzip-dev \
    && docker-php-ext-install dom xml mbstring zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
