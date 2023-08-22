#!/bin/sh

# Configura php-fpm (si es necesario)
# ...

# Inicia php-fpm
chmod -R 777 /var/www/storage/
php-fpm
cd /var/www/; composer install
