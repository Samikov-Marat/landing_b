#!/bin/sh

EXPECTED_CHECKSUM="$(php -r "readfile('https://composer.github.io/installer.sig');" )"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php  --version=2.4.2 --quiet
RESULT=$?
rm composer-setup.php
mv composer.phar /usr/local/bin/composer

echo 'composer_setup_script.sh finished'

exit $RESULT
