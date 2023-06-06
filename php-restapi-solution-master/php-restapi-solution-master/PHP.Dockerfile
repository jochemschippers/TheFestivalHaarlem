FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN pecl install apcu && \
    docker-php-ext-enable apcu
COPY php.ini /usr/local/etc/php/

	