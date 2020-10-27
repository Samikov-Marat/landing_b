FROM php:7.4-fpm

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && \
    apt-get install -y \
    libzip-dev && \
    docker-php-ext-install zip pdo_mysql
#     && \
#    docker-php-ext-enable pdo pdo_mysql

RUN cd /var/www/html && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'c31c1e292ad7be5f49291169c0ac8f683499edddcfd4e42232982d0fd193004208a58ff6f353fde0012d35fdd72bc394') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --version=1.10.16 && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer
