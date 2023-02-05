FROM composer:2.5 AS composer
FROM php:8.2-cli

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y \
        unzip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && apt-get clean

WORKDIR /srv/app
