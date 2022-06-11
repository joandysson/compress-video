ARG PHP_VERSION

FROM php:$PHP_VERSION-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN set -eux; apt-get update; apt-get install -y git \
    && apt-get install -y --no-install-recommends ffmpeg

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 777 /var/www/html/

# sudo chmod -R a+rwx,o-wrx .

RUN a2enmod rewrite
