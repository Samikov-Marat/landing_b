FROM php:7.2.33-fpm
ARG USER_ID
ARG GROUP_ID

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

RUN addgroup --gid $GROUP_ID user
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID user
USER user
