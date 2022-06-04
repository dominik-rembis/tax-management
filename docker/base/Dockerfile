FROM php:8.1.5-apache-buster AS tax_management_base

WORKDIR /var/www/tax_management/

RUN a2enmod rewrite

RUN apt update && apt install -y unzip libicu-dev libxml2-dev

RUN docker-php-ext-install opcache intl pdo xml pdo_mysql
RUN docker-php-ext-enable pdo_mysql

COPY --from=composer:2.2.12 /usr/bin/composer /usr/bin/composer