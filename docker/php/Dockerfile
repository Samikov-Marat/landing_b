FROM php:7.4-fpm

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && \
    apt-get install -y \
    libzip-dev && \
    docker-php-ext-install zip pdo_mysql
#     && \
#    docker-php-ext-enable pdo pdo_mysql

COPY ./composer_setup_script.sh /var/tmp
RUN cd /var/tmp && chmod 700 ./composer_setup_script.sh && ./composer_setup_script.sh

WORKDIR /app
